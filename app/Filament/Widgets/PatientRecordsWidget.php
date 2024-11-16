<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientRecordsWidget extends TableWidget
{
    protected static ?string $heading = 'Patient Records';

    public static function canView(): bool
    {
        $user = Auth::user();
        return $user && ($user->userRole->name === 'admin' || $user->userRole->name === 'doctor' || $user->userRole->name === 'receptionist');
    }
    /**
     * Get the table query to fetch patient data.
     */
    protected function getTableQuery(): Builder
    {
        return Patient::query()
            ->orderBy('last_name')  // Sort by last name first
            ->orderBy('first_name'); // Then sort by first name
    }

    /**
     * Define the table columns.
     */
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('first_name')
                ->label('First Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('last_name')
                ->label('Last Name')
                ->sortable()
                ->searchable(),

           

            TextColumn::make('gender')
                ->label('Gender')
                ->sortable()
                ->searchable(),

            TextColumn::make('address')
                ->label('Address')
                ->sortable()
                ->searchable(),

            TextColumn::make('phone_number')
                ->label('Phone Number')
                ->sortable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),
        ];
    }

    /**
     * Configure table actions and filters.
     */
    protected function getTableFilters(): array
    {
        return [
            //
            // Add filters here if needed
            // Example:
            // SelectFilter::make('gender')
            //     ->options([
            //         'Male' => 'Male',
            //         'Female' => 'Female',
            //     ])
            //     ->label('Gender'),
        ];
    }
}
