<?php

namespace Feraandrei1\FilamentAiChatWidget;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class FilamentAiChatPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-ai-chat-widget';
    }

    public function register(Panel $panel): void
    {
        $panel->renderHook(
            PanelsRenderHook::BODY_START,
            fn(): string => Auth::check()
                ? Blade::render('@livewire(\'ai-chat-widget\')')
                : ''
        );
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }
}
