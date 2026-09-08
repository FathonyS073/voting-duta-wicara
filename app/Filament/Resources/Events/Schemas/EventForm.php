<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Event')
                    ->schema([

                        TextInput::make('name')
                            ->label('Nama Event')
                            ->required()
                            ->maxLength(255),


                        TextInput::make('slug')
                            ->label('Slug Event')
                            ->required()
                            ->unique(ignoreRecord: true),


                        Textarea::make('description')
                            ->label('Deskripsi Event')
                            ->rows(5)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),


                Section::make('Media Event')
                    ->schema([

                        FileUpload::make('logo')
                            ->label('Logo Event')
                            ->image()
                            ->directory('events/logo'),


                        FileUpload::make('banner')
                            ->label('Banner Event')
                            ->image()
                            ->directory('events/banner'),

                    ])
                    ->columns(2),


                Section::make('Periode Voting')
                    ->schema([

                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required(),


                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required(),


                    ])
                    ->columns(2),


                Section::make('Status')
                    ->schema([

                        Toggle::make('status')
                            ->label('Event Aktif')
                            ->default(true),

                    ]),

            ]);
    }
}