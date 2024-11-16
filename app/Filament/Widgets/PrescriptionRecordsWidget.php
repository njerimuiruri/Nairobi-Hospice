<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PrescriptionRecordsWidget extends TableWidget
{
    protected static ?string $heading = 'Prescription Records';

    public static function canView(): bool
    {
        $user = Auth::user();
        return $user && ($user->userRole->name === 'admin' || $user->userRole->name === 'doctor' || $user->userRole->name === 'receptionist' || $user->userRole->name === 'pharmacist');
    }
    /**
     * Get the table query to fetch prescription data.
     */
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Prescription::query()
            ->with(['patient', 'doctor']) // Ensure relations are loaded
            ->orderBy('start_date', 'desc'); // Sort by prescription start date
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

            TextColumn::make('medication_name')
                ->label('Medication Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('dosage')
                ->label('Dosage')
                ->sortable(),

            TextColumn::make('start_date')
                ->label('Start Date')
                ->sortable()
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d M, Y')), // Format start date as text

            TextColumn::make('end_date')
                ->label('End Date')
                ->sortable()
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d M, Y')), // Format end date as text

            TextColumn::make('status')
                ->label('Status')
                ->sortable()
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
