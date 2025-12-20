<?php

namespace Feraandrei1\FilamentAiChatWidget\Filament\Resources\AiKnowledgeBaseResource\Pages;

use Feraandrei1\FilamentAiChatWidget\Filament\Resources\AiKnowledgeBaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAiKnowledgeBases extends ListRecords
{
    protected static string $resource = AiKnowledgeBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
