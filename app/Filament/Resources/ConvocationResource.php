<?php

namespace App\Filament\Resources;

use App\Models\Convocation;
use Filament\{Tables, Forms, ImageColumn};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\ConvocationResource\Pages;

class ConvocationResource extends Resource
{
    protected static ?string $model = Convocation::class;

    protected static ?string $modelLabel = 'Convocatoria';

    protected static ?string $pluralModelLabel = 'Convocatorias';

    protected static ?string $navigationLabel = 'Convocatorias';

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('name')
                                    ->rules(['required', 'max:255', 'string'])
                                    ->required()
                                    ->placeholder('Ingresa el nombre de la convocatoria')
                                    ->label('Nombre'),

                                DateTimePicker::make('start_time')
                                    ->rules(['nullable', 'date'])
                                    ->placeholder('Ingresa la hora y fecha de inicio')
                                    ->label('Inicio del evento'),

                                DateTimePicker::make('end_time')
                                    ->rules(['nullable', 'date'])
                                    ->placeholder('Ingresa la hora y fecha de cierre')
                                    ->label('Cierre del evento'),
                            ]),
                        Forms\Components\Section::make('Redes sociales')
                            ->schema([
                                TextInput::make('zoom_url')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->url()
                                    ->placeholder('Ingresa el enlace de la sala de zoom')
                                    ->label('Enlace de Zoom'),

                                TextInput::make('whatsapp_url')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->url()
                                    ->placeholder('Ingresa el enlace del grupo de whatsapp')
                                    ->label('Enlace de Whatsapp'),
                            ]),
                        Forms\Components\Section::make('Logo')
                            ->schema([
                                FileUpload::make('logo_path')
                                    ->rules(['file', 'max:1024', 'nullable'])
                                    ->enableDownload()
                                    ->disableLabel()
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Estado')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Visible')
                                    ->default(true),

                                DatePicker::make('inscription_start_date')
                                    ->rules(['nullable', 'date'])
                                    ->label('Inicio de inscripciones')
                                    ->default(now()),

                                DatePicker::make('inscription_end_date')
                                    ->rules(['nullable', 'date'])
                                    ->label('Cierre de inscripciones')
                                    ->default(now()->addWeek()),
                            ]),

                        Forms\Components\Section::make('Asistencia')
                            ->schema([
                                TextInput::make('presencial_limit')
                                    ->rules(['nullable', 'max:255'])
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(255)
                                    ->placeholder('Puestos disponibles para presencial')
                                    ->label('Limite Presencial'),

                                TextInput::make('virtual_limit')
                                    ->rules(['nullable', 'max:255'])
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(255)
                                    ->placeholder('Puestos disponibles para virtual')
                                    ->label('Limite Virtual'),
                            ]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Creación')
                                    ->content(fn(Convocation $record): string => $record->created_at->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Convocation $record): string => $record->updated_at->diffForHumans()),
                            ])
                            ->hidden(fn(?Convocation $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->limit(50)
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inscription_start_date')
                    ->date()
                    ->toggleable()
                    ->label('Inicio de Inscripciones')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inscription_end_date')
                    ->date()
                    ->toggleable()
                    ->label('Cierre de Inscripciones')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->toggleable()
                    ->label('Inicio del Evento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->toggleable()
                    ->label('Cierre del Evento')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_visible')
                    ->label('Visibilidad')
                    ->sortable(),
                Tables\Columns\TextColumn::make('presencial_limit')
                    ->toggleable()
                    ->label('Disponible Presencial'),
                Tables\Columns\TextColumn::make('virtual_limit')
                    ->toggleable()
                    ->label('Disponible Virtual'),
                Tables\Columns\TextColumn::make('zoom_url')
                    ->limit(50)
                    ->toggleable()
                    ->url(fn(Convocation $record): string => $record->zoom_url)
                    ->openUrlInNewTab()
                    ->label('Enlace de Zoom'),
                Tables\Columns\TextColumn::make('whatsapp_url')
                    ->limit(50)
                    ->toggleable()
                    ->url(fn(Convocation $record): string => $record->whatsapp_url)
                    ->openUrlInNewTab()
                    ->label('Enlace de Whatsapp'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConvocations::route('/'),
            'create' => Pages\CreateConvocation::route('/create'),
            'edit' => Pages\EditConvocation::route('/{record}/edit'),
        ];
    }
}
