<?php

namespace App\Filament\Resources\FeatureResource\RelationManagers;

use App\Models\PricingPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricingPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'pricingPlans';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pricing_plan_id')
                    ->label('Pricing Plan')
                    ->options(PricingPlan::pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('value')
                    ->required()
                    ->label('Value')
                    ->helperText(function () {
                        $feature = $this->getOwnerRecord();
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
                    ->label('Plan Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->getStateUsing(fn($record) => $record->pivot->value),

                Tables\Columns\TextColumn::make('display_value')
                    ->label('Display Value')
                    ->getStateUsing(function ($record) {
                        return $record->pivot->display_value ?:
                            $this->getOwnerRecord()->getDisplayValueForPlan($record->id, $record->pivot->value);
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
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn(Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
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
            ]);
    }
}
