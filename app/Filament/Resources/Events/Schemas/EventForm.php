<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

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
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText(
                                'Digunakan sebagai URL halaman event.'
                            ),

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
                            ->disk('public')
                            ->directory('events/logo')
                            ->visibility('public'),

                        FileUpload::make('banner')
                            ->label('Banner Event')
                            ->image()
                            ->disk('public')
                            ->directory('events/banner')
                            ->visibility('public'),

                    ])
                    ->columns(2),


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
                            ->native(false)
                            ->helperText(
                                'Hanya event aktif yang seharusnya menerima voting.'
                            ),

                    ]),

            ]);
    }
}