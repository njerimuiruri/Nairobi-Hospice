<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultationResource\Pages;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Doctor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction; // Correct import for EditAction
use Filament\Tables\Actions\DeleteBulkAction; // Correct import for DeleteBulkAction
use Filament\Tables\Actions\BulkActionGroup; // Correct import for BulkActionGroup

use Illuminate\Support\Facades\Auth;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function canViewAny(): bool
    {
        $userRole = Auth::user()->userRole->name;
        return in_array($userRole, ['admin', 'doctor']);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->userRole->name === 'admin' || Auth::user()->userRole->name === 'doctor';
    }

    public static function canEdit($record): bool
    {
        $userRole = Auth::user()->userRole->name;
        return $userRole === 'admin' || 
               ($userRole === 'doctor' && Auth::user()->id === $record->doctor_id);
    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('patient_id')
                ->label('Patient')
                ->options(
                    Patient::whereNotNull('first_name')
                        ->whereNotNull('last_name')
                        ->get()
                        ->mapWithKeys(function ($patient) {
                            $fullName = trim("{$patient->first_name} {$patient->last_name}");
                            return [$patient->id => $fullName ?: 'Unknown Patient'];
                        })
                )
                ->searchable()
                ->required(),

            Select::make('doctor_id')
                ->label('Doctor')
                ->options(
                    Doctor::whereNotNull('first_name')
                        ->whereNotNull('last_name')
                        ->get()
                        ->mapWithKeys(function ($doctor) {
                            $fullName = trim("{$doctor->first_name} {$doctor->last_name}");
                            return [$doctor->id => $fullName ?: 'Unknown Doctor'];
                        })
                )
                ->searchable()
                ->required()
                ->default(auth()->id()),

            DatePicker::make('consultation_date')
                ->label('Consultation Date')
                ->default(now())
                ->required(),

            Textarea::make('notes')
                ->label('Medical Notes')
                ->required(),

            Textarea::make('prescription')
                ->label('Prescription')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')->label('Patient')->sortable()->searchable(),
                TextColumn::make('doctor.full_name')->label('Doctor')->sortable()->searchable(),
                TextColumn::make('consultation_date')->sortable(),
                TextColumn::make('notes')->label('Notes')->limit(50),
                TextColumn::make('prescription')->label('Prescription')->limit(50),
            ])
            ->actions([
                // Tables\Actions\EditAction::make()
                // ->visible(fn () => Auth::user()->userRole->name === 'admin' || Auth::user()->userRole->name === 'doctor'),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }
}
