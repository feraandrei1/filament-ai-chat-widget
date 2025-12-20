<?php

namespace Feraandrei1\FilamentAiChatWidget;

use Feraandrei1\FilamentAiChatWidget\Livewire\AiChatWidget;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FilamentAiChatServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'filament-ai-chat-widget');

        $this->publishes([
            __DIR__ . '/database/migrations/create_ai_conversations_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_ai_conversations_table.php'),
            __DIR__ . '/database/migrations/create_ai_knowledge_bases_table.php' => database_path('migrations/' . date('Y_m_d_His', time() + 1) . '_create_ai_knowledge_bases_table.php'),
        ], 'filament-ai-chat-widget-migrations');

        $this->publishes([
            __DIR__ . '/config/openai.php' => config_path('openai.php'),
        ], 'filament-ai-chat-widget-config');

        $this->publishes([
            __DIR__ . '/resources/css/ai-chat-widget.css' => public_path('vendor/filament-ai-chat-widget/ai-chat-widget.css'),
        ], 'filament-ai-chat-widget-assets');

        Livewire::component('ai-chat-widget', AiChatWidget::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/openai.php',
            'openai'
        );
    }
}
