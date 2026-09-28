<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\Pages\CreateEvent;
use App\Filament\Resources\Events\Pages\EditEvent;
use App\Filament\Resources\Events\Pages\ListEvents;
use App\Filament\Resources\Events\Schemas\EventForm;
use App\Filament\Resources\Events\Tables\EventsTable;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\Vote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Events';

    protected static ?string $modelLabel = 'Event';

    protected static ?string $pluralModelLabel = 'Events';

    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Schema $schema): Schema
    {
        return EventForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->addSelect([
                'categories_count' => Category::query()
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('event_id', 'events.id'),

                'candidates_count' => Candidate::query()
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('event_id', 'events.id'),

                'total_votes' => Vote::query()
                    ->selectRaw('COALESCE(SUM(vote_amount), 0)')
                    ->whereColumn('event_id', 'events.id'),

                'total_revenue' => Transaction::query()
                    ->selectRaw('COALESCE(SUM(total_amount), 0)')
                    ->whereColumn('event_id', 'events.id')
                    ->where('payment_status', 'paid'),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}