<?php

namespace App\Filament\Resources\SchoolResource\Pages;

use App\Models\User;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SchoolResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class EditSchool extends EditRecord
{
    protected static string $resource = SchoolResource::class;

    protected function afterCreate(): void
    {
        $recipient = auth()->user();

        Notification::make()
            ->title('Saved successfully jsjsjs')
            ->success()
            ->sendToDatabase($recipient);
    }
}
