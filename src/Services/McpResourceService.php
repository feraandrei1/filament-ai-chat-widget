<?php

namespace Feraandrei1\FilamentAiChatWidget\Services;

use Feraandrei1\FilamentAiChatWidget\Mcp\Resources\KnowledgeResource;
use Feraandrei1\FilamentAiChatWidget\Mcp\Resources\RulesResource;
use Feraandrei1\FilamentAiChatWidget\Mcp\Servers\LocalServer;

class McpResourceService
{
    public static function getSystemInstructions(): array
    {
        $messages = [];

        $server = new LocalServer();

        if (! empty($server->instructions)) {
            $messages[] = [
                'role' => 'system',
                'content' => $server->instructions,
            ];
        }

        $rulesResource = new RulesResource();
        $rulesData = json_decode($rulesResource->read(), true);

        if (isset($rulesData['rules']) && is_array($rulesData['rules'])) {
            foreach ($rulesData['rules'] as $rule) {
                $messages[] = [
                    'role' => 'system',
                    'content' => $rule,
                ];
            }
        }

        $knowledgeResource = new KnowledgeResource();
        $knowledgeData = json_decode($knowledgeResource->read(), true);

        if (isset($knowledgeData['knowledge']) && is_array($knowledgeData['knowledge'])) {
            foreach ($knowledgeData['knowledge'] as $knowledge) {
                $messages[] = [
                    'role' => 'system',
                    'content' => $knowledge['content'],
                ];
            }
        }

        return $messages;
    }

    public static function getInstructionsAsString(): string
    {
        $instructions = self::getSystemInstructions();

        return collect($instructions)
            ->map(fn($message) => $message['content'])
            ->join("\n\n");
    }

    public static function getInstructionsCount(): int
    {
        return count(self::getSystemInstructions());
    }
}
