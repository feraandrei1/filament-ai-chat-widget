# Filament AI Chat

AI chat widget for Filament v3 with OpenAI integration.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Filament](https://img.shields.io/badge/Filament-v3-orange.svg)
![Laravel](https://img.shields.io/badge/Laravel-v11-red.svg)

### Screenshots

![Chat Widget](screenshot.png)

## Requirements

* PHP 8.1+
* Laravel 11.x
* Filament 3.x
* OpenAI API key

## Installation

Install via Composer:

```bash
composer require ferarandrei1/filament-ai-chat-widget
```

Run migrations:

```bash
php artisan vendor:publish --tag="filament-ai-chat-widget-migrations"
php artisan migrate
```

Add your OpenAI API key to `.env`:

```env
OPENAI_API_KEY=sk-your-api-key-here
OPENAI_ORGANIZATION=your-organization-here
```

Register the plugin & knowledge resource in your Panel Provider:

```php
use Feraandrei1\FilamentAiChatWidget\FilamentAiChatPlugin;
use Feraandrei1\FilamentAiChatWidget\Filament\Resources\AiKnowledgeBaseResource;

public function panel(Panel $panel): Panel
{
    return $panel
        ->resources([
            AiKnowledgeBaseResource::class,
        ])
        ->plugins([
            FilamentAiChatPlugin::make(),
        ]);
}
```

Clear caches:

```bash
php artisan optimize:clear
```

## Usage

The chat widget appears automatically on all panel pages for authenticated users.

### Customization

You can customize the behavior and appearance of the widget by publishing the configuration:

```bash
php artisan vendor:publish --tag="filament-ai-chat-widget-config"
```

Then edit `config/filament-ai-chat-widget.php` to adjust settings like:

* Default AI model
* Chat history limit
* UI appearance

## License

MIT License
