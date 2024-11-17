<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DoctorProfileResource\Pages;
use App\Models\DoctorProfile;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn; // Use TextColumn instead

class DoctorProfileResource extends Resource
{
    protected static ?string $model = DoctorProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('first_name')
                ->label('First Name')
                ->required()
                ->disabled()
                ->default(auth()->user()->first_name),

            Forms\Components\TextInput::make('last_name')
                ->label('Last Name')
                ->required()
                ->disabled()
                ->default(auth()->user()->last_name),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->disabled()
                ->default(auth()->user()->email),

            Forms\Components\TextInput::make('phone_number')
                ->label('Phone Number')
                ->required()
                ->disabled()
                ->default(auth()->user()->phone_number),

            Forms\Components\TextInput::make('specialization')
                ->label('Specialization')
                ->required()
                ->disabled()
                ->default(auth()->user()->specialization),

            Forms\Components\Select::make('availability_status')
                ->label('Availability Status')
                ->options([
                    'Available' => 'Available',
                    'Busy' => 'Busy',
                    'Unavailable' => 'Unavailable',
                ])
                ->required()
                ->default(auth()->user()->availability_status),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->label('First Name'),
                TextColumn::make('last_name')->label('Last Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone_number')->label('Phone Number'),
                TextColumn::make('specialization')->label('Specialization'),
                TextColumn::make('availability_status')->label('Availability Status'),
            ])
            ->filters([
                // You can add filters here for status or other attributes
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctorProfiles::route('/'),
            'create' => Pages\CreateDoctorProfile::route('/create'),
            'view' => Pages\ViewDoctorProfile::route('/{record}'),
            'edit' => Pages\EditDoctorProfile::route('/{record}/edit'),
        ];
    }
}
