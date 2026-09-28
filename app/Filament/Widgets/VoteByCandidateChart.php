<?php

namespace App\Filament\Widgets;

use App\Models\Vote;
use Filament\Widgets\ChartWidget;

class VoteByCandidateChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Perolehan Vote per Finalis';

    protected function getData(): array
    {
        $votes = Vote::query()
            ->with('candidate')
            ->select('candidate_id')
            ->selectRaw('SUM(vote_amount) as total_votes')
            ->groupBy('candidate_id')
            ->orderByDesc('total_votes')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Vote',
                    'data' => $votes
                        ->pluck('total_votes')
                        ->map(fn ($value) => (int) $value)
                        ->values()
                        ->all(),
                ],
            ],

            'labels' => $votes
                ->map(fn ($vote) => $vote->candidate?->name ?? 'Tidak diketahui')
                ->values()
                ->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}