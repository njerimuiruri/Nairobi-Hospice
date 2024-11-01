<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ConsultationsRelationManager extends RelationManager
{
    protected static string $relationship = 'consultations';
    protected static ?string $recordTitleAttribute = 'consultation_date';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('consultation_date')->label('Date')->sortable(),
                TextColumn::make('doctor.full_name')->label('Doctor'),
                TextColumn::make('notes')->label('Medical Notes')->limit(50),
                TextColumn::make('prescription')->label('Prescription')->limit(50),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }
}
