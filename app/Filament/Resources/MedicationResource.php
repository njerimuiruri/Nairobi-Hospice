<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationResource\Pages;
use App\Models\Medication;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MedicationResource extends Resource
{
    protected static ?string $model = Medication::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Textarea::make('description')->nullable(),
                TextInput::make('stock')
                    ->numeric()
                    ->label('Stock Quantity')
                    ->required(),
            ])
            ->saved(fn ($record) => $record->checkStockAndNotifyAdmin());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('stock')->label('Stock Quantity')->sortable(),
            ])
            ->filters([])
            ->actions([
                // Tables\Actions\EditAction::make()
                    // ->visible(fn () => Auth::user()->hasRole('pharmacist') || Auth::user()->hasRole('admin')),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return Auth::user()->hasRole(['admin', 'pharmacist']);
    // }
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedications::route('/'),
            'create' => Pages\CreateMedication::route('/create'),
            'edit' => Pages\EditMedication::route('/{record}/edit'),
        ];
    }
}
