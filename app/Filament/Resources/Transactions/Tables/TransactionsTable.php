<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use App\Models\Vote;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            /*
            |--------------------------------------------------------------------------
            | COLUMNS
            |--------------------------------------------------------------------------
            */

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


                /*
                |--------------------------------------------------------------------------
                | PAYMENT METHOD
                |--------------------------------------------------------------------------
                */

                TextColumn::make('payment_method')
                    ->label('Metode')
                    ->placeholder('-')
                    ->badge()
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'manual_qris' => 'QRIS Manual',
                            'qris' => 'QRIS',
                            default => $state
                                ? strtoupper($state)
                                : '-',
                        }
                    )
                    ->color(
                        fn (?string $state): string => match ($state) {
                            'manual_qris' => 'warning',
                            'qris' => 'success',
                            default => 'gray',
                        }
                    ),


                /*
                |--------------------------------------------------------------------------
                | PAYMENT STATUS
                |--------------------------------------------------------------------------
                */

                TextColumn::make('payment_status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'paid' => 'Berhasil',
                            'pending' => 'Pending',
                            'waiting_confirmation' => 'Menunggu Verifikasi',
                            'failed' => 'Gagal / Ditolak',
                            'expired' => 'Kedaluwarsa',
                            default => ucfirst($state),
                        }
                    )
                    ->color(
                        fn (string $state): string => match ($state) {
                            'paid' => 'success',
                            'pending' => 'warning',
                            'waiting_confirmation' => 'warning',
                            'failed' => 'danger',
                            'expired' => 'danger',
                            default => 'gray',
                        }
                    )
                    ->sortable(),

                TextColumn::make('payment_reference')
                    ->label('Midtrans Ref.')
                    ->copyable()
                    ->placeholder('-')
                    ->toggleable(
                        isToggledHiddenByDefault: true
                    ),

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


            /*
            |--------------------------------------------------------------------------
            | FILTERS
            |--------------------------------------------------------------------------
            */

            ->filters([

                SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'paid' => 'Berhasil',
                        'pending' => 'Pending',
                        'waiting_confirmation' => 'Menunggu Verifikasi',
                        'failed' => 'Gagal / Ditolak',
                        'expired' => 'Kedaluwarsa',
                    ]),

                SelectFilter::make('event_id')
                    ->label('Event')
                    ->relationship(
                        'event',
                        'name'
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('candidate_id')
                    ->label('Finalis')
                    ->relationship(
                        'candidate',
                        'name'
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship(
                        'category',
                        'name'
                    )
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
                        function (
                            Builder $query,
                            array $data
                        ): Builder {

                            return $query

                                ->when(
                                    $data['dari'] ?? null,
                                    fn (
                                        Builder $query,
                                        $date
                                    ): Builder =>
                                        $query->whereDate(
                                            'created_at',
                                            '>=',
                                            $date
                                        )
                                )

                                ->when(
                                    $data['sampai'] ?? null,
                                    fn (
                                        Builder $query,
                                        $date
                                    ): Builder =>
                                        $query->whereDate(
                                            'created_at',
                                            '<=',
                                            $date
                                        )
                                );
                        }
                    ),
            ])


            /*
            |--------------------------------------------------------------------------
            | RECORD ACTIONS
            |--------------------------------------------------------------------------
            */

            ->recordActions([

                ActionGroup::make([


                    /*
                    |--------------------------------------------------------------------------
                    | LIHAT BUKTI
                    |--------------------------------------------------------------------------
                    */

                    Action::make('viewPaymentProof')
                        ->label('Lihat Bukti')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->visible(
                            fn (Transaction $record): bool =>
                                $record->payment_method === 'manual_qris'
                                && filled($record->payment_proof)
                        )
                        ->url(
                            fn (Transaction $record): string =>
                                Storage::disk('public')
                                    ->url($record->payment_proof)
                        )
                        ->openUrlInNewTab(),


                    /*
                    |--------------------------------------------------------------------------
                    | VERIFIKASI PEMBAYARAN
                    |--------------------------------------------------------------------------
                    */

                    Action::make('verifyManualPayment')
                        ->label('Verifikasi')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading(
                            'Verifikasi Pembayaran Manual'
                        )
                        ->modalDescription(
                            fn (Transaction $record): string =>
                                'Pastikan bukti pembayaran untuk invoice '
                                . $record->invoice_number
                                . ' sudah sesuai dengan nominal Rp '
                                . number_format(
                                    $record->total_amount,
                                    0,
                                    ',',
                                    '.'
                                )
                                . '. Setelah diverifikasi, vote akan langsung dimasukkan.'
                        )
                        ->modalSubmitActionLabel(
                            'Ya, Verifikasi'
                        )
                        ->visible(
                            fn (Transaction $record): bool =>
                                $record->payment_method === 'manual_qris'
                                && $record->payment_status === 'waiting_confirmation'
                                && filled($record->payment_proof)
                        )
                        ->action(
                            function (
                                Transaction $record
                            ): void {

                                DB::transaction(
                                    function () use ($record): void {

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Lock Transaction
                                        |--------------------------------------------------------------------------
                                        */

                                        $transaction =
                                            Transaction::query()
                                                ->whereKey(
                                                    $record->getKey()
                                                )
                                                ->lockForUpdate()
                                                ->firstOrFail();


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Pastikan Manual QRIS
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            $transaction->payment_method
                                                !== 'manual_qris'
                                        ) {
                                            return;
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Hanya Waiting Confirmation
                                        |--------------------------------------------------------------------------
                                        |
                                        | Jika sudah paid / failed, jangan proses ulang.
                                        |
                                        */

                                        if (
                                            $transaction->payment_status
                                                !== 'waiting_confirmation'
                                        ) {
                                            return;
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Pastikan Bukti Ada
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            blank(
                                                $transaction->payment_proof
                                            )
                                        ) {
                                            return;
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Update Transaction
                                        |--------------------------------------------------------------------------
                                        */

                                        $transaction->update([
                                            'payment_status' => 'paid',
                                            'paid_at' =>
                                                $transaction->paid_at
                                                ?? now(),
                                        ]);


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Create Vote
                                        |--------------------------------------------------------------------------
                                        |
                                        | Aman terhadap double click / proses ulang:
                                        |
                                        | 1. DB::transaction()
                                        | 2. lockForUpdate()
                                        | 3. Vote::firstOrCreate()
                                        | 4. UNIQUE votes.transaction_id
                                        |
                                        */

                                        Vote::firstOrCreate(
                                            [
                                                'transaction_id' =>
                                                    $transaction->id,
                                            ],
                                            [
                                                'event_id' =>
                                                    $transaction->event_id,

                                                'category_id' =>
                                                    $transaction->category_id,

                                                'candidate_id' =>
                                                    $transaction->candidate_id,

                                                'vote_amount' =>
                                                    $transaction->vote_amount,
                                            ]
                                        );
                                    }
                                );


                                Notification::make()
                                    ->title(
                                        'Pembayaran berhasil diverifikasi'
                                    )
                                    ->body(
                                        'Status transaksi menjadi Berhasil dan vote telah dimasukkan.'
                                    )
                                    ->success()
                                    ->send();
                            }
                        ),


                    /*
                    |--------------------------------------------------------------------------
                    | TOLAK PEMBAYARAN
                    |--------------------------------------------------------------------------
                    */

                    Action::make('rejectManualPayment')
                        ->label('Tolak')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading(
                            'Tolak Pembayaran Manual'
                        )
                        ->modalDescription(
                            fn (Transaction $record): string =>
                                'Pembayaran invoice '
                                . $record->invoice_number
                                . ' akan ditolak. Vote tidak akan dimasukkan.'
                        )
                        ->modalSubmitActionLabel(
                            'Ya, Tolak Pembayaran'
                        )
                        ->visible(
                            fn (Transaction $record): bool =>
                                $record->payment_method === 'manual_qris'
                                && $record->payment_status === 'waiting_confirmation'
                        )
                        ->action(
                            function (
                                Transaction $record
                            ): void {

                                DB::transaction(
                                    function () use ($record): void {

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Lock Transaction
                                        |--------------------------------------------------------------------------
                                        */

                                        $transaction =
                                            Transaction::query()
                                                ->whereKey(
                                                    $record->getKey()
                                                )
                                                ->lockForUpdate()
                                                ->firstOrFail();


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Validasi Manual QRIS
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            $transaction->payment_method
                                                !== 'manual_qris'
                                        ) {
                                            return;
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Jangan Ubah Transaksi Yang Sudah Diproses
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            $transaction->payment_status
                                                !== 'waiting_confirmation'
                                        ) {
                                            return;
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Reject
                                        |--------------------------------------------------------------------------
                                        */

                                        $transaction->update([
                                            'payment_status' => 'failed',
                                            'paid_at' => null,
                                        ]);
                                    }
                                );


                                Notification::make()
                                    ->title(
                                        'Pembayaran ditolak'
                                    )
                                    ->body(
                                        'Transaksi ditandai gagal dan vote tidak dimasukkan.'
                                    )
                                    ->danger()
                                    ->send();
                            }
                        ),

                ]),

            ])


            /*
            |--------------------------------------------------------------------------
            | DEFAULT SORT
            |--------------------------------------------------------------------------
            */

            ->defaultSort(
                'created_at',
                'desc'
            );
    }
}