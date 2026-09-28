<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->circular()
                    ->size(50),

                TextColumn::make('name')
                    ->label('Nama Event')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(35),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('categories_count')
                    ->label('Kategori')
                    ->formatStateUsing(
                        fn ($state) =>
                            number_format((int) ($state ?? 0), 0, ',', '.') . ' Kategori'
                    )
                    ->alignCenter(),

                TextColumn::make('candidates_count')
                    ->label('Finalis')
                    ->formatStateUsing(
                        fn ($state) =>
                            number_format((int) ($state ?? 0), 0, ',', '.') . ' Finalis'
                    )
                    ->alignCenter(),

                TextColumn::make('total_votes')
                    ->label('Total Vote')
                    ->formatStateUsing(
                        fn ($state) =>
                            number_format((int) ($state ?? 0), 0, ',', '.') . ' Vote'
                    )
                    ->weight('bold')
                    ->alignCenter(),

                TextColumn::make('total_revenue')
                    ->label('Pendapatan')
                    ->formatStateUsing(
                        fn ($state) =>
                            'Rp ' . number_format((int) ($state ?? 0), 0, ',', '.')
                    )
                    ->weight('bold'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'draft' => 'Draft',
                            'active' => 'Aktif',
                            'closed' => 'Ditutup',
                            'finished' => 'Selesai',
                            default => ucfirst($state),
                        }
                    )
                    ->color(
                        fn (string $state): string => match ($state) {
                            'draft' => 'gray',
                            'active' => 'success',
                            'closed' => 'warning',
                            'finished' => 'info',
                            default => 'gray',
                        }
                    ),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([

                SelectFilter::make('status')
                    ->label('Status Event')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Aktif',
                        'closed' => 'Ditutup',
                        'finished' => 'Selesai',
                    ]),

            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}