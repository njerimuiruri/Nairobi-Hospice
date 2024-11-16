<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;

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
use Filament\Tables\Columns\TextColumn; 
use Illuminate\Support\Facades\Auth;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function canViewAny(): bool
    {
        // Allow viewing for admin, doctor, and receptionist
        $userRole = Auth::user()->userRole->name;
        return in_array($userRole, ['admin', 'doctor', 'receptionist']);
    }

    public static function canCreate(): bool
    {
        // Allow creating records for admin and receptionist
        return in_array(Auth::user()->userRole->name, ['admin', 'receptionist']);
    }

    public static function canEdit($record): bool
    {
        // Allow editing for admin, assigned doctor, and receptionist
        return Auth::user()->userRole->name === 'admin' ||
               (Auth::user()->userRole->name === 'doctor' && $record->doctor_id === Auth::id()) ||
               Auth::user()->userRole->name === 'receptionist';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),

                DatePicker::make('date_of_birth')->required(),
                TextInput::make('gender')->required(),
                TextInput::make('address')->required(),
                TextInput::make('phone_number')->required(),
                TextInput::make('email')->required()->email()->unique(),
                Select::make('doctor_id')
                ->label('Assign Doctor')
                ->options(function () {
                    return Doctor::where('availability_status', 'Available')
                        ->get()
                        ->mapWithKeys(function ($doctor) {
                            return [$doctor->id => $doctor->full_name];
                        });
                })
                ->searchable()
                ->placeholder('Select an available doctor')
                ->required(),
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),

                TextColumn::make('date_of_birth'),
                TextColumn::make('gender'),
                TextColumn::make('phone_number'),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('doctor.first_name')->label('Assigned Doctor')->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            // Tables\Actions\EditAction::make()
            //     ->visible(fn () => Auth::user()->userRole->name === 'admin' || Auth::user()->userRole->name === 'doctor'),

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
          
                \App\Filament\Resources\PatientResource\RelationManagers\ConsultationsRelationManager::class,
            ];       
    }
//     public static function shouldRegisterNavigation(): bool
// {
//     return Auth::user()->hasRole('admin');
// }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
    
}
