<?php

namespace App\Filament\Resources\DoctorResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DoctorConsultationRelationManager extends RelationManager
{
    protected static string $relationship = 'consultations';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('consultation_date')->label('Date')->sortable(),
                TextColumn::make('patient.full_name')->label('Patient'),
                TextColumn::make('notes')->label('Medical Notes')->limit(50),
                TextColumn::make('prescription')->label('Prescription')->limit(50),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }
}
