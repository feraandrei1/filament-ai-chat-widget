<?php

namespace Feraandrei1\FilamentAiChatWidget\Filament\Resources\AiKnowledgeBaseResource\Pages;

use Feraandrei1\FilamentAiChatWidget\Filament\Resources\AiKnowledgeBaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAiKnowledgeBase extends EditRecord
{
    protected static string $resource = AiKnowledgeBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
