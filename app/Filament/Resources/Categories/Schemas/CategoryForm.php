<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Models\Event;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Kategori')
                    ->schema([

                        Select::make('event_id')
                            ->label('Event')
                            ->relationship('event', 'name')
                            ->required(),


                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255),


                        TextInput::make('vote_price')
                            ->label('Harga Per Vote')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),


                        Textarea::make('description')
                            ->label('Deskripsi Kategori')
                            ->rows(4)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),


                Section::make('Status')
                    ->schema([

                        Toggle::make('status')
                            ->label('Kategori Aktif')
                            ->default(true),

                    ]),

            ]);
    }
}