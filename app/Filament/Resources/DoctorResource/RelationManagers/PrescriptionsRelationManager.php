<?php

namespace App\Filament\Resources\DoctorResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptions';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('medication.name')->label('Medication')->sortable()->searchable(),
                TextColumn::make('dosage')->label('Dosage')->sortable(),
                TextColumn::make('start_date')->sortable(),
                TextColumn::make('end_date')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
}
