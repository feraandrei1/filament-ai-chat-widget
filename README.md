# Filament AI Chat

A beautiful, production-ready AI chat widget plugin for Filament v3 with OpenAI integration.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Filament](https://img.shields.io/badge/Filament-v3-orange.svg)
![Laravel](https://img.shields.io/badge/Laravel-v11-red.svg)

## Features

- Floating AI chat widget that appears on all Filament panel pages
- Full conversation history persistence
- Knowledge base system with active/inactive entries
- MCP (Model Context Protocol) integration for context management
- Customizable AI rules and guidelines
- Beautiful, responsive UI with dark mode support
- Real-time typing indicators
- Markdown/HTML formatted responses
- User-specific conversations
- Token usage tracking

## Screenshots

The widget appears as a floating button in the bottom-right corner of your Filament panel, providing instant AI assistance to your users.

## Requirements

- PHP 8.1 or higher
- Laravel 11.x
- Filament 3.x
- Livewire 3.x
- OpenAI API key

## Installation

### 1. Install via Composer

```bash
composer require ferarandrei1/filament-ai-chat-widget
```

### 2. Publish and Run Migrations

```bash
php artisan vendor:publish --tag="filament-ai-chat-widget-migrations"
php artisan migrate
```

### 3. Configure OpenAI

Add your OpenAI API key to your `.env` file:

```env
OPENAI_API_KEY=sk-your-api-key-here
OPENAI_ORGANIZATION=your-organization-here
```

### 4. Register the Plugin

Add the plugin to your Filament Panel Provider (e.g., `app/Providers/Filament/AppPanelProvider.php`):

```php
use Feraandrei1\FilamentAiChatWidget\FilamentAiChatPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ... other configuration
        ->plugins([
            FilamentAiChatPlugin::make(),
            // ... other plugins
        ]);
}
```

### 5. Clear Caches

```bash
php artisan optimize:clear
```

## Usage

Once installed, the AI chat widget will automatically appear on all pages of your Filament panel for authenticated users.

### Adding Knowledge Base Entries

Knowledge base entries are system messages that provide context to the AI. You can add them directly to the database:

```php
use Feraandrei1\FilamentAiChatWidget\Models\AiKnowledgeBase;

AiKnowledgeBase::create([
    'name' => 'Product Information',
    'content' => 'Our application is an e-commerce platform that sells t-shirts.',
    'active' => true,
    'order_column' => 1,
]);
```

### Customizing AI Behavior

The AI behavior is controlled through the MCP Resources. You can customize the rules by publishing and modifying the package files:

```bash
php artisan vendor:publish --tag="filament-ai-chat-widget-config" --force
```

Then edit the `RulesResource` class to modify AI behavior and guidelines.

### Customizing Appearance

To customize the chat widget appearance, publish the views:

```bash
php artisan vendor:publish --tag="filament-ai-chat-widget-views" --force
```

The views will be published to `resources/views/vendor/filament-ai-chat-widget/`.

## Configuration

### Model Settings

Default AI model settings can be customized when creating conversations. The defaults are:

- Model: `gpt-4o-mini`
- Temperature: `0.5`
- Max Tokens: `500`

### User Model

The package uses Laravel's default authentication model. The `AiConversation` model automatically binds to `config('auth.providers.users.model')`.

## Database Structure

### ai_conversations

Stores chat conversations for each user:

- `user_id` - Foreign key to users table
- `messages` - JSON array of conversation messages
- `model` - OpenAI model used (default: gpt-4o-mini)
- `temperature` - AI temperature setting
- `max_tokens` - Maximum tokens per response
- `tokens_used` - Total tokens consumed
- Timestamps and soft deletes

### ai_knowledge_bases

Stores knowledge base entries for context:

- `name` - Entry name/title
- `content` - System message content
- `active` - Boolean to enable/disable
- `order_column` - Sort order (lower = higher priority)
- Timestamps and soft deletes

## MCP Architecture

The package uses Model Context Protocol (MCP) for AI orchestration:

- **LocalServer**: Main MCP server with base instructions
- **KnowledgeResource**: Retrieves active knowledge base entries
- **RulesResource**: Provides hardcoded AI behavior rules
- **McpResourceService**: Aggregates all context for OpenAI API calls

## Advanced Usage

### Creating a Filament Resource for Knowledge Base

```php
use Feraandrei1\FilamentAiChatWidget\Models\AiKnowledgeBase;
use Filament\Resources\Resource;

class AiKnowledgeBaseResource extends Resource
{
    protected static ?string $model = AiKnowledgeBase::class;

    // ... implement your resource
}
```

### Accessing Conversation History

```php
use Feraandrei1\FilamentAiChatWidget\Models\AiConversation;

$conversations = AiConversation::where('user_id', auth()->id())
    ->latest()
    ->get();
```

### Customizing System Instructions

Override the `LocalServer` instructions:

```php
use Feraandrei1\FilamentAiChatWidget\Mcp\Servers\LocalServer;

class CustomLocalServer extends LocalServer
{
    public string $instructions = <<<'MARKDOWN'
        Your custom AI instructions here...
    MARKDOWN;
}
```

## Security

- All conversations are user-specific and protected by authentication
- Input validation is performed on all chat messages (max 256 characters)
- SQL injection protection via Eloquent ORM
- XSS protection via proper HTML escaping

## Performance

- Conversations are cached in the database
- Efficient JSON storage for message history
- Lazy loading of knowledge base entries
- Minimal JavaScript footprint

## Troubleshooting

### Widget not appearing

1. Ensure you've registered the plugin in your Panel Provider
2. Clear caches: `php artisan optimize:clear`
3. Verify you're authenticated when viewing the panel

### OpenAI API errors

1. Verify your API key is set correctly in `.env`
2. Check API quota and billing status
3. Review error logs: `storage/logs/laravel.log`

### JavaScript errors

1. Ensure Livewire is properly installed
2. Clear browser cache
3. Check browser console for specific errors

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Credits

- [Feraru Andrei](https://github.com/ferarandrei)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

For support, please open an issue on GitHub or contact the maintainer.
