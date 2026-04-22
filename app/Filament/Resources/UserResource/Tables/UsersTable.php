<?php

namespace App\Filament\Resources\UserResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),
                TextColumn::make('courses_count')
                    ->label('Cursos')
                    ->getStateUsing(fn ($record) => $record->courses->count())
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('payment_methods')
                    ->label('Pago con')
                    ->getStateUsing(function ($record) {
                        return $record->courses->pluck('pivot.payment_method')->unique()->filter()->join(', ');
                    })
                    ->badge()
                    ->color('success'),
                TextColumn::make('created_at')
                    ->label('Registrado')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
