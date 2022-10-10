<?php

namespace App\Filament\Resources;

use App\Models\Convocation;
use App\Models\Inscription;
use App\Models\School;
use Ramsey\Uuid\Uuid;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\InscriptionResource\Pages;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $modelLabel = 'Inscripción';

    protected static ?string $pluralModelLabel = 'Inscripciones';

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Select::make('convocation_id')
                                            ->label('Convocatoria')
                                            ->rules(['required', 'exists:convocations,id'])
                                            ->options(Convocation::where('is_visible', true)->pluck('name', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->placeholder('Selecciona una convocatoria'),

                                        Select::make('school_id')
                                            ->label('Escuela')
                                            ->rules(['required', 'exists:schools,id'])
                                            ->options(School::where('visible', true)->pluck('name', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->placeholder('Selecciona una escuela'),
                                    ]),
                                TextInput::make('code')
                                    ->rules(['required', 'uuid'])
                                    ->unique(
                                        'inscriptions',
                                        'code',
                                        fn(?Model $record) => $record
                                    )
                                    ->disabled()
                                    ->label('Código')
                                    ->default(Uuid::uuid4())
                            ]),
                        Forms\Components\Section::make('Datos Personales')
                            ->schema([
                                TextInput::make('name')
                                    ->rules(['required', 'max:255', 'string'])
                                    ->placeholder('Name'),

                                TextInput::make('email')
                                    ->rules(['required', 'email'])
                                    ->email()
                                    ->placeholder('Email'),

                                TextInput::make('phone')
                                    ->rule('required')
                                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('(000) 000-0000'))
                                    ->placeholder('Teléfono'),

                                Select::make('education')
                                    ->rules(['required', 'in:1,2,3'])
                                    ->searchable()
                                    ->options([
                                        '1' => 'Estudiante',
                                        '2' => 'Pasante',
                                        '3' => 'Docente',
                                    ])
                                    ->placeholder('Selecciona el rol de académico')
                                    ->label('Rol Académico'),
                            ]),
                        Forms\Components\Section::make('Comprobante')
                            ->schema([
                                FileUpload::make('receipt_path')
                                    ->rules(['file', 'max:1024', 'nullable'])
                                    ->enableDownload()
                                    ->required()
                                    ->disableLabel(),
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Estado')
                            ->schema([
                                Forms\Components\Toggle::make('approved')
                                    ->label('Aprobado')
                                    ->default(false),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Select::make('modality')
                                    ->rules(['required', 'in:1,2'])
                                    ->searchable()
                                    ->options([
                                        '1' => 'Presencial',
                                        '2' => 'Virtual',
                                    ])
                                    ->placeholder('Selecciona una modalidad')
                                    ->label('Modalidad'),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Creación')
                                    ->content(fn(Inscription $record): string => $record->created_at->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Inscription $record): string => $record->updated_at->diffForHumans()),
                            ])
                            ->hidden(fn(?Inscription $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->limit(50)
                    ->label('Correo'),
                Tables\Columns\TextColumn::make('convocation.name')
                    ->limit(50)
                    ->toggleable()
                    ->label('Convocatoria'),
                Tables\Columns\TextColumn::make('school.name')
                    ->limit(50)
                    ->toggleable()
                    ->label('Escuela'),
                Tables\Columns\TextColumn::make('education')->enum([
                    '1' => 'Estudiante',
                    '2' => 'Pasante',
                    '3' => 'Docente',
                ])
                    ->label('Educación')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('modality')->enum([
                    '1' => 'Presencial',
                    '2' => 'Virtual',
                ])
                    ->label('Modalidad')
                    ->toggleable(),
                Tables\Columns\BooleanColumn::make('approved')
                    ->label('Estado')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Creado a partir del'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Creado hasta el'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                            $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                            $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('convocation_id')->relationship(
                    'convocation',
                    'name'
                )->label('Convocatoria'),

                MultiSelectFilter::make('school_id')->relationship(
                    'school',
                    'name'
                )->label('Escuela'),

                Tables\Filters\SelectFilter::make('modality')->options([
                    '1' => 'Presencial',
                    '2' => 'Virtual',
                ])->label('Modalidad'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscriptions::route('/'),
            'create' => Pages\CreateInscription::route('/create'),
            'edit' => Pages\EditInscription::route('/{record}/edit'),
        ];
    }
}
