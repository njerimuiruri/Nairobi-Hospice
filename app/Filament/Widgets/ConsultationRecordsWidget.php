<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use App\Models\Consultation;
use Carbon\Carbon;

class ConsultationRecordsWidget extends TableWidget
{
    protected static ?string $heading = 'Consultation Records';

    /**
     * Get the table query to fetch consultation data.
     */
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Consultation::query()
            ->with(['patient', 'doctor']) // Load patient and doctor relationships
            ->orderBy('consultation_date', 'desc'); // Sort by consultation date
    }

    /**
     * Define the table columns.
     */
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('patient.first_name')
                ->label('Patient Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('doctor.first_name')
                ->label('Doctor Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('consultation_date')
                ->label('Consultation Date')
                ->sortable()
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d M, Y')), // Format date as text

            TextColumn::make('notes')
                ->label('Notes')
                ->searchable(),

            TextColumn::make('prescription')
                ->label('Prescription')
                ->searchable(),
        ];
    }

    /**
     * Configure the layout to ensure the table spans the full width (col-12).
     */
    protected function getTableLayout(): string
    {
        return 'filament::widgets.table'; // Default Filament table layout
    }
}
