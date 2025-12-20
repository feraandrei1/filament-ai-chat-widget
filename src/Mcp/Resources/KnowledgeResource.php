<?php

namespace Feraandrei1\FilamentAiChatWidget\Mcp\Resources;

use Feraandrei1\FilamentAiChatWidget\Models\AiKnowledgeBase;
use Laravel\Mcp\Server\Resource;

class KnowledgeResource extends Resource
{
    protected string $description = 'AI knowledge base retrieved from the ai_knowledge_bases table';

    public function read(): string
    {
        $aiKnowledgeBases = AiKnowledgeBase::where('active', true)
            ->orderBy('order_column')
            ->get();

        $knowledge = $aiKnowledgeBases->map(function ($aiKnowledgeBase) {
            return [
                'id' => $aiKnowledgeBase->id,
                'name' => $aiKnowledgeBase->name,
                'content' => $aiKnowledgeBase->content,
                'order' => $aiKnowledgeBase->order_column,
            ];
        })->toArray();

        return json_encode([
            'type' => 'knowledge',
            'knowledge' => $knowledge,
            'count' => count($knowledge),
        ], JSON_PRETTY_PRINT);
    }
}
