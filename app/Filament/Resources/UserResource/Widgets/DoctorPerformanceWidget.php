<?php
namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\Doctor; 
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DoctorPerformanceWidget extends TableWidget
{
    protected static ?string $heading = 'Doctor Performance';

    /**
     * Get the query to fetch data for the table.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getTableQuery(): Builder
    {
        return Doctor::query() // Assuming Doctor is the model
            ->withCount(['consultations as monthly_consultations' => function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month);
            }])
            ->withAvg(['consultations as average_rating' => function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month);
            }], 'rating')
            ->orderByDesc('monthly_consultations')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Doctor Name')
                ->searchable(),
            TextColumn::make('monthly_consultations')
                ->label('Monthly Consultations')
                ->sortable(),
            TextColumn::make('average_rating')
                ->label('Avg Rating')
                ->formatStateUsing(fn ($state) => number_format($state, 1))
                ->sortable(),
        ];
    }
}
