<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Select, Textarea, DatePicker, Toggle, FileUpload};
use Filament\Tables\Columns\{TextColumn, BadgeColumn, ImageColumn};

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('name')
            ->required()
            ->maxLength(255),

        Textarea::make('description')
            ->required()
            ->maxLength(1000),

        Select::make('type')
            ->options([
                'lost' => 'Lost',
                'found' => 'Found',
            ])
            ->required(),

        Select::make('status')
            ->options([
                'active' => 'Active',
                'returned' => 'Returned',
                'claimed' => 'Claimed',
            ])
            ->required(),

        Select::make('category')
            ->options([
                'electronics' => 'Electronics',
                'clothing' => 'Clothing',
                'accessories' => 'Accessories',
                'books' => 'Books & Stationery',
                'keys' => 'Keys',
                'wallet' => 'Wallets & Purses',
                'phone' => 'Mobile Phones',
                'bag' => 'Bags & Backpacks',
                'jewelry' => 'Jewelry',
                'documents' => 'Documents & Cards',
                'sports' => 'Sports Equipment',
                'other' => 'Other',
            ])
            ->required(),

        TextInput::make('location')->required(),

        DatePicker::make('date_lost_found')->required(),

        TextInput::make('contact_info'),

        Toggle::make('reward_offered')
            ->label('Reward Offered')
            ->reactive(),

        TextInput::make('reward_amount')
            ->label('Reward Amount (KES)')
            ->numeric()
            ->visible(fn ($get) => $get('reward_offered')),

        FileUpload::make('image_path')
            ->label('Upload Image')
            ->image()
            ->directory('items')
            ->disk('public'),
    ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->searchable()->sortable(),

            BadgeColumn::make('type')
                ->colors([
                    'primary' => 'lost',
                    'success' => 'found',
                ])
                ->sortable(),

            BadgeColumn::make('status')
                ->colors([
                    'danger' => 'active',
                    'info' => 'returned',
                    'warning' => 'claimed',
                ])
                ->sortable(),
                TextColumn::make('user.name')->label('Reported By')->sortable()->searchable(),


            TextColumn::make('category')->sortable(),
            TextColumn::make('location')->sortable(),
            TextColumn::make('date_lost_found')->date(),
            ImageColumn::make('image_path')->label('Image')->rounded(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('type')->options([
                'lost' => 'Lost',
                'found' => 'Found',
            ]),
            Tables\Filters\SelectFilter::make('status')->options([
                'active' => 'Active',
                'returned' => 'Returned',
                'claimed' => 'Claimed',
            ]),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
