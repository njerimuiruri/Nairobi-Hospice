<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;

class SortUsers extends Page
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.sort-users';
  
    public $query;

    public function mount(): void
    {
        $this->query = 'Hello world!';
    }

}
