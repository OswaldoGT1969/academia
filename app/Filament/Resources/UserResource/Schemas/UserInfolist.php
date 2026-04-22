<?php

namespace App\Filament\Resources\UserResource\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('email')
                    ->label('Correo Electrónico'),
                TextEntry::make('courses.title')
                    ->label('Cursos Inscritos')
                    ->badge()
                    ->color('info')
                    ->placeholder('Ninguno'),
                TextEntry::make('created_at')
                    ->label('Fecha de Registro')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
