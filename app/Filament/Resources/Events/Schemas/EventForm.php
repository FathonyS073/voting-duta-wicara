<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;


class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | Informasi Event
                |--------------------------------------------------------------------------
                */

                Section::make('Informasi Event')
                    ->schema([

                        TextInput::make('name')
                            ->label('Nama Event')
                            ->required()
                            ->maxLength(255),


                        TextInput::make('slug')
                            ->label('Slug Event')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),


                        Textarea::make('description')
                            ->label('Deskripsi Event')
                            ->rows(5)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),



                /*
                |--------------------------------------------------------------------------
                | Media Event
                |--------------------------------------------------------------------------
                */

                Section::make('Media Event')
                    ->schema([

                        FileUpload::make('logo')
                            ->label('Logo Event')
                            ->image()
                            ->disk('public')
                            ->directory('events/logo'),


                        FileUpload::make('banner')
                            ->label('Banner Event')
                            ->image()
                            ->disk('public')
                            ->directory('events/banner'),

                    ])
                    ->columns(2),



                /*
                |--------------------------------------------------------------------------
                | Periode Voting
                |--------------------------------------------------------------------------
                */

                Section::make('Periode Voting')
                    ->schema([

                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required(),


                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->afterOrEqual('start_date'),

                    ])
                    ->columns(2),



                /*
                |--------------------------------------------------------------------------
                | Status Event
                |--------------------------------------------------------------------------
                */

                Section::make('Status Event')
                    ->schema([

                        Select::make('status')
                            ->label('Status')
                            ->options([

                                'draft' => 'Draft',
                                'active' => 'Aktif',
                                'closed' => 'Ditutup',
                                'finished' => 'Selesai',

                            ])
                            ->default('draft')
                            ->required()
                            ->native(false),

                    ]),

            ]);
    }
}