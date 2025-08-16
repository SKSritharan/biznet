<?php

namespace App\Filament\Resources\PricingPlanResource\RelationManagers;

use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeaturesRelationManager extends RelationManager
{
    protected static string $relationship = 'features';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('feature_id')
                    ->label('Feature')
                    ->options(Feature::active()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $feature = Feature::find($state);
                            if ($feature) {
                                // Set default value based on feature type
                                match ($feature->type) {
                                    'boolean' => $set('value', 'true'),
                                    'numeric' => $set('value', '1'),
                                    'select' => $set('value', $feature->options[0] ?? ''),
                                    default => null,
                                };
                            }
                        }
                    }),

                Forms\Components\TextInput::make('value')
                    ->required()
                    ->label('Value')
                    ->helperText(function (Forms\Get $get) {
                        if (!$get('feature_id')) return 'Select a feature first';

                        $feature = Feature::find($get('feature_id'));
                        if (!$feature) return '';

                        return match ($feature->type) {
                            'boolean' => 'Enter "true" or "false"',
                            'numeric' => 'Enter a number, or "-1" for unlimited',
                            'select' => 'Choose from: ' . implode(', ', $feature->options ?? []),
                            default => 'Enter the value for this feature',
                        };
                    }),

                Forms\Components\TextInput::make('display_value')
                    ->label('Display Value')
                    ->helperText('How this should be displayed (leave empty for auto-generation)'),

                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Sort Order'),

                Forms\Components\Toggle::make('is_highlighted')
                    ->label('Highlight this feature for this plan')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Feature Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'boolean' => 'success',
                        'numeric' => 'warning',
                        'select' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->getStateUsing(fn($record) => $record->pivot->value),

                Tables\Columns\TextColumn::make('display_value')
                    ->label('Display Value')
                    ->getStateUsing(function ($record) {
                        return $record->pivot->display_value ?:
                            $record->getDisplayValueForPlan($this->getOwnerRecord()->id, $record->pivot->value);
                    }),

                Tables\Columns\IconColumn::make('is_highlighted')
                    ->boolean()
                    ->label('Highlighted')
                    ->getStateUsing(fn($record) => (bool) $record->pivot->is_highlighted),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->pivot->sort_order),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'boolean' => 'Boolean',
                        'numeric' => 'Numeric',
                        'select' => 'Select',
                    ]),
                Tables\Filters\TernaryFilter::make('is_highlighted')
                    ->label('Highlighted Features')
                    ->attribute('pivot.is_highlighted'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn(Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->options(Feature::active()->pluck('name', 'id'))
                            ->searchable(),
                        Forms\Components\TextInput::make('value')
                            ->required()
                            ->label('Value'),
                        Forms\Components\TextInput::make('display_value')
                            ->label('Display Value'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_highlighted')
                            ->default(false),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\TextInput::make('value')
                            ->required()
                            ->label('Value'),
                        Forms\Components\TextInput::make('display_value')
                            ->label('Display Value'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_highlighted')
                            ->default(false),
                    ]),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }
}
