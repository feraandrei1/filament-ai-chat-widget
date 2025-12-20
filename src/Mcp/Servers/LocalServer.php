<?php

namespace Feraandrei1\FilamentAiChatWidget\Mcp\Servers;

use Feraandrei1\FilamentAiChatWidget\Mcp\Resources;
use Laravel\Mcp\Server;

class LocalServer extends Server
{
    public string $serverName = 'local';

    public string $serverVersion = '0.0.1';

    public string $instructions;

    public array $tools = [];

    public array $resources = [
        Resources\RulesResource::class,
        Resources\KnowledgeResource::class,
    ];

    public array $prompts = [];

    public function __construct()
    {
        $appName = config('app.name');

        $this->instructions = <<<MARKDOWN
            You are an AI assistant exclusively for the {$appName} application.
            Your role is to help users understand and use this application effectively.
            Be warm and professional with greetings and pleasantries, but guide all conversations toward helping with the application.
            Politely decline requests unrelated to this application. Maintain confidentiality and prioritize user privacy.
        MARKDOWN;

        parent::__construct();
    }
}
