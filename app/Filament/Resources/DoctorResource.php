<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction; // Import EditAction
use Filament\Tables\Actions\ViewAction; // Import ViewAction
use Filament\Tables\Actions\DeleteBulkAction; // Import DeleteBulkAction
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\Response;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->label('First Name')->required(),
                TextInput::make('last_name')->label('Last Name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('phone_number')->label('Phone')->required(),
                TextInput::make('specialization')->label('Specialization')->required(),

                Select::make('availability_status')
                    ->label('Availability Status')
                    ->options([
                        'Available' => 'Available',
                        'Busy' => 'Busy',
                        'Unavailable' => 'Unavailable',
                    ])
                    ->default('Available')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->label('Name')->sortable()->searchable(),
                TextColumn::make('specialization')->label('Specialization')->sortable()->searchable(),
                TextColumn::make('availability_status')->label('Availability'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            \App\Filament\Resources\DoctorResource\RelationManagers\DoctorConsultationRelationManager::class,
            \App\Filament\Resources\DoctorResource\RelationManagers\PrescriptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
