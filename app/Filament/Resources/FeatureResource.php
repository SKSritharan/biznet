<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Billing';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Feature Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $context, $state, Forms\Set $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Feature::class, 'slug', ignoreRecord: true)
                            ->rules(['alpha_dash']),

                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Feature Configuration')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->required()
                            ->options([
                                'boolean' => 'Boolean (Yes/No)',
                                'numeric' => 'Numeric (Count/Limit)',
                                'select' => 'Select (Options)',
                            ])
                            ->live()
                            ->afterStateUpdated(fn(Forms\Set $set) => $set('options', null)),

                        Forms\Components\TextInput::make('unit')
                            ->label('Unit')
                            ->helperText('e.g., "users", "GB", "projects" (optional)')
                            ->visible(fn(Forms\Get $get): bool => $get('type') === 'numeric'),

                        Forms\Components\TagsInput::make('options')
                            ->label('Available Options')
                            ->helperText('Enter the available options for this feature')
                            ->visible(fn(Forms\Get $get): bool => $get('type') === 'select')
                            ->required(fn(Forms\Get $get): bool => $get('type') === 'select'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('Sort Order'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

//                Tables\Columns\TextColumn::make('type')
//                    ->badge()
//                    ->color(fn(string $state): string => match ($state) {
//                        'boolean' => 'success',
//                        'numeric' => 'warning',
//                        'select' => 'info',
//                        default => 'gray',
//                    }),

                Tables\Columns\TextColumn::make('unit')
                    ->label('Unit')
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('options')
                    ->label('Options')
                    ->getStateUsing(fn($record) => $record->options ? implode(', ', $record->options) : '—')
                    ->limit(30),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),

                Tables\Columns\TextColumn::make('pricing_plans_count')
                    ->counts('pricingPlans')
                    ->label('Used in Plans'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Features'),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'boolean' => 'Boolean',
                        'numeric' => 'Numeric',
                        'select' => 'Select',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PricingPlansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
