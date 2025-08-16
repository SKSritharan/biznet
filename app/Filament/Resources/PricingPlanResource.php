<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingPlanResource\Pages;
use App\Filament\Resources\PricingPlanResource\RelationManagers;
use App\Filament\Resources\PricingPlanResource\Widgets\PricingPlanStats;
use App\Models\PricingPlan;
use App\Services\StripeService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PricingPlanResource extends Resource
{
    protected static ?string $model = PricingPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Billing';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Plan Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $context, $state, Forms\Set $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(PricingPlan::class, 'slug', ignoreRecord: true)
                            ->rules(['alpha_dash']),

                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01),

                        Forms\Components\Select::make('billing_period')
                            ->required()
                            ->options([
                                'monthly' => 'Monthly',
                                'yearly' => 'Yearly',
                                'weekly' => 'Weekly',
                                'one-time' => 'One-time',
                            ])
                            ->default('monthly'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Stripe Integration')
                    ->schema([
                        Forms\Components\TextInput::make('stripe_product_id')
                            ->label('Stripe Product ID')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('stripe_price_id')
                            ->label('Stripe Price ID')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Plan')
                            ->default(false),

                        Forms\Components\KeyValue::make('metadata')
                            ->label('Additional Metadata')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('billing_period')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'monthly' => 'success',
                        'yearly' => 'warning',
                        'weekly' => 'info',
                        'one-time' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),

                Tables\Columns\TextColumn::make('features_count')
                    ->counts('features')
                    ->label('Features'),

                Tables\Columns\TextColumn::make('stripe_product_id')
                    ->label('Stripe Product')
                    ->limit(20)
                    ->tooltip(fn($record) => $record->stripe_product_id)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('stripe_price_id')
                    ->label('Stripe Price')
                    ->limit(20)
                    ->tooltip(fn($record) => $record->stripe_price_id)
                    ->toggleable(isToggledHiddenByDefault: true),

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
                    ->label('Active Plans'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Plans'),
                Tables\Filters\SelectFilter::make('billing_period')
                    ->options([
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                        'weekly' => 'Weekly',
                        'one-time' => 'One-time',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('sync_to_stripe')
                    ->label('Sync to Stripe')
                    ->icon('heroicon-o-credit-card')
                    ->color('success')
                    ->action(function (PricingPlan $record) {
                        $stripeService = app(StripeService::class);

                        if (!$record->stripe_product_id || !$record->stripe_price_id) {
                            $result = $stripeService->createPlanInStripe($record);
                        } else {
                            $result = $stripeService->updatePlanInStripe($record);
                        }

                        if ($result['success']) {
                            Notification::make()
                                ->title('Success')
                                ->body('Plan synced to Stripe successfully!')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Error')
                                ->body('Failed to sync plan to Stripe: ' . $result['error'])
                                ->danger()
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Sync Plan to Stripe')
                    ->modalDescription('This will create or update the plan in Stripe. Are you sure?'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('sync_to_stripe')
                        ->label('Sync to Stripe')
                        ->icon('heroicon-o-credit-card')
                        ->color('success')
                        ->action(function ($records) {
                            $stripeService = app(StripeService::class);
                            $successCount = 0;
                            $failureCount = 0;

                            foreach ($records as $record) {
                                if (!$record->stripe_product_id || !$record->stripe_price_id) {
                                    $result = $stripeService->createPlanInStripe($record);
                                } else {
                                    $result = $stripeService->updatePlanInStripe($record);
                                }

                                if ($result['success']) {
                                    $successCount++;
                                } else {
                                    $failureCount++;
                                }
                            }

                            Notification::make()
                                ->title('Bulk Sync Complete')
                                ->body("Successfully synced {$successCount} plans. {$failureCount} failed.")
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Sync Plans to Stripe')
                        ->modalDescription('This will create or update the selected plans in Stripe. Are you sure?'),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FeaturesRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PricingPlanStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPricingPlans::route('/'),
            'create' => Pages\CreatePricingPlan::route('/create'),
            'edit' => Pages\EditPricingPlan::route('/{record}/edit'),
        ];
    }
}
