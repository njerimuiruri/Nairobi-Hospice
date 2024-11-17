<?php
namespace App\Filament\Resources\DoctorProfileResource\Pages;

use App\Filament\Resources\DoctorProfileResource;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;

class CreateDoctorProfile extends CreateRecord
{
    protected static string $resource = DoctorProfileResource::class;

    protected function getFormSchema(): array
    {
        return [
            // First name (pre-filled and disabled)
            Forms\Components\TextInput::make('first_name')
                ->label('First Name')
                ->required()
                ->default(auth()->user()->first_name)  // Pre-fill with logged-in doctor's first name
                ->disabled(),  // Disable to prevent editing

            // Last name (pre-filled and disabled)
            Forms\Components\TextInput::make('last_name')
                ->label('Last Name')
                ->required()
                ->default(auth()->user()->last_name)  // Pre-fill with logged-in doctor's last name
                ->disabled(),  // Disable to prevent editing

            // Email (pre-filled and disabled)
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->default(auth()->user()->email)  // Pre-fill with logged-in doctor's email
                ->disabled(),  // Disable to prevent editing

            // Phone number (pre-filled and disabled)
            Forms\Components\TextInput::make('phone_number')
                ->label('Phone Number')
                ->required()
                ->default(auth()->user()->phone_number)  // Pre-fill with logged-in doctor's phone number
                ->disabled(),  // Disable to prevent editing

            // Specialization (pre-filled and disabled)
            Forms\Components\TextInput::make('specialization')
                ->label('Specialization')
                ->required()
                ->default(auth()->user()->specialization)  // Pre-fill with logged-in doctor's specialization
                ->disabled(),  // Disable to prevent editing

            // Availability status (editable by the doctor)
            Forms\Components\Select::make('availability_status')
                ->label('Availability Status')
                ->options([
                    'Available' => 'Available',
                    'Busy' => 'Busy',
                    'Unavailable' => 'Unavailable',
                ])
                ->required()  // Make it required to choose a status
                ->default(auth()->user()->availability_status)  // Pre-fill with the current status of the logged-in doctor
        ];
    }
}
