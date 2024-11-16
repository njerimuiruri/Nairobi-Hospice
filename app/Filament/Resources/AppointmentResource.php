<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;


class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    public static function canViewAny(): bool
    {
        $userRole = Auth::user()->userRole->name;
        return in_array($userRole, ['admin', 'receptionist', 'doctor']);
    }

    public static function canCreate(): bool
    {
        return Auth::user()->userRole->name === 'receptionist' || Auth::user()->userRole->name === 'admin';
    }

    public static function canEdit($record): bool
    {
        $userRole = Auth::user()->userRole->name;
        return $userRole === 'admin' || $userRole === 'receptionist' || 
            ($userRole === 'doctor' && Auth::user()->id === $record->doctor_id);
    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('patient_id')
            ->label('Patient')
            ->options(Patient::whereNotNull('first_name')
                ->get()
                ->mapWithKeys(function ($patient) {
                    return [$patient->id => "{$patient->first_name} {$patient->last_name}"];
                }))
            ->required(),
            Select::make('doctor_id')
            ->label('Doctor')
            ->options(Doctor::whereNotNull('first_name')
                ->get()
                ->mapWithKeys(function ($doctor) {
                    return [$doctor->id => "{$doctor->first_name} {$doctor->last_name}"];
                }))
            ->required(),
            DatePicker::make('appointment_date')->required(),
            TimePicker::make('appointment_time')->required(),
            TextInput::make('description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('patient.first_name')->label('Patient First Name')->sortable()->searchable(),
            TextColumn::make('patient.last_name')->label('Patient Last Name')->sortable()->searchable(),

            TextColumn::make('doctor.first_name')->label('Doctor First Name')->sortable(),
            TextColumn::make('doctor.first_name')->label('Doctor Last Name')->sortable(),

            TextColumn::make('appointment_date')->sortable(),
            TextColumn::make('appointment_time')->sortable(),
            TextColumn::make('status')->sortable(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            // Tables\Actions\EditAction::make()
            //     ->visible(fn () => Auth::user()->userRole->name === 'admin' || Auth::user()->userRole->name === 'receptionist'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
