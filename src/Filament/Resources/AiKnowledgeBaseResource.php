<?php

namespace Feraandrei1\FilamentAiChatWidget\Filament\Resources;

use Feraandrei1\FilamentAiChatWidget\Filament\Resources\AiKnowledgeBaseResource\Pages;
use Feraandrei1\FilamentAiChatWidget\Models\AiKnowledgeBase;

use Illuminate\Database\Eloquent\Builder;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AiKnowledgeBaseResource extends Resource
{
    protected static ?string $model = AiKnowledgeBase::class;

    protected static ?int $navigationSort = 11;

    protected static function orderByOrderColumn(Builder $query): Builder
    {
        return $query->orderBy('order_column');
    }

    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make()

                            ->schema([

                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('content')
                                    ->required()
                                    ->rows(8)
                                    ->columnSpanFull()
                                    ->helperText('Knowledge that will be sent to the AI assistant'),

                                Forms\Components\Toggle::make('active')
                                    ->required()
                                    ->default(true)
                                    ->helperText('Only active knowledge are used by the AI'),

                            ])->columns(2),

                    ])->columnSpan(1),

            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                static::orderByOrderColumn(AiKnowledgeBase::query())
            )
            ->reorderable('order_column')
            ->recordTitleAttribute('order_column')
            ->columns([

                Tables\Columns\TextColumn::make('order_column')
                    ->translateLabel()
                    ->label('Order'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),

                Tables\Filters\TernaryFilter::make('active')
                    ->label('Active')
                    ->boolean()
                    ->trueLabel('Only active')
                    ->falseLabel('Only inactive')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAiKnowledgeBases::route('/'),
            'create' => Pages\CreateAiKnowledgeBase::route('/create'),
            'edit' => Pages\EditAiKnowledgeBase::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('AI knowledge base');
    }

    public static function getPluralModelLabel(): string
    {
        return __('AI knowledge bases');
    }

    public static function getNavigationGroup(): string
    {
        return __('Support');
    }
}
