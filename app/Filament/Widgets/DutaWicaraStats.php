<?php

namespace App\Filament\Widgets;

use App\Models\Candidate;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\Vote;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DutaWicaraStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalEvents = Event::query()->count();

        $totalCandidates = Candidate::query()->count();

        $totalVotes = Vote::query()->sum('vote_amount');

        $totalTransactions = Transaction::query()->count();

        $paidTransactions = Transaction::query()
            ->where('payment_status', 'paid')
            ->count();

        $pendingTransactions = Transaction::query()
            ->where('payment_status', 'pending')
            ->count();

        $failedTransactions = Transaction::query()
            ->where('payment_status', 'failed')
            ->count();

        $totalRevenue = Transaction::query()
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        return [

            Stat::make(
                'Total Event',
                number_format($totalEvents)
            )
                ->description('Event yang tersedia')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make(
                'Total Finalis',
                number_format($totalCandidates)
            )
                ->description('Seluruh kandidat')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make(
                'Total Vote',
                number_format($totalVotes)
            )
                ->description('Vote yang telah masuk')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make(
                'Total Transaksi',
                number_format($totalTransactions)
            )
                ->description('Seluruh transaksi')
                ->descriptionIcon('heroicon-m-receipt-percent')
                ->color('warning'),

            Stat::make(
                'Transaksi Berhasil',
                number_format($paidTransactions)
            )
                ->description('Pembayaran berhasil')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make(
                'Transaksi Pending',
                number_format($pendingTransactions)
            )
                ->description('Menunggu pembayaran')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make(
                'Transaksi Gagal',
                number_format($failedTransactions)
            )
                ->description('Pembayaran gagal')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make(
                'Total Pendapatan',
                'Rp ' . number_format(
                    $totalRevenue,
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Dari transaksi berhasil')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}