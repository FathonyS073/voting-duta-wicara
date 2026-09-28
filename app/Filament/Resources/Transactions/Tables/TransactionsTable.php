<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->placeholder('-'),

                TextColumn::make('candidate.name')
                    ->label('Finalis')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('vote_amount')
                    ->label('Vote')
                    ->numeric()
                    ->suffix(' Vote')
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Metode')
                    ->placeholder('-')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('payment_status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'paid' => 'Berhasil',
                            'pending' => 'Pending',
                            'failed' => 'Gagal',
                            default => ucfirst($state),
                        }
                    )
                    ->color(
                        fn (string $state): string => match ($state) {
                            'paid' => 'success',
                            'pending' => 'warning',
                            'failed' => 'danger',
                            default => 'gray',
                        }
                    )
                    ->sortable(),

                TextColumn::make('payment_reference')
                    ->label('Midtrans Ref.')
                    ->copyable()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('paid_at')
                    ->label('Dibayar')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])

            ->filters([

                SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'paid' => 'Berhasil',
                        'pending' => 'Pending',
                        'failed' => 'Gagal',
                    ]),

                SelectFilter::make('event_id')
                    ->label('Event')
                    ->relationship('event', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('candidate_id')
                    ->label('Finalis')
                    ->relationship('candidate', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('tanggal')
                    ->label('Tanggal Transaksi')
                    ->schema([
                        DatePicker::make('dari')
                            ->label('Dari'),

                        DatePicker::make('sampai')
                            ->label('Sampai'),
                    ])
                    ->query(
                        function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['dari'] ?? null,
                                    fn (Builder $query, $date): Builder =>
                                        $query->whereDate('created_at', '>=', $date)
                                )
                                ->when(
                                    $data['sampai'] ?? null,
                                    fn (Builder $query, $date): Builder =>
                                        $query->whereDate('created_at', '<=', $date)
                                );
                        }
                    ),
            ])

            ->defaultSort('created_at', 'desc');
    }
}