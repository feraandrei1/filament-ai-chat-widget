# Changelog

All notable changes to `filament-ai-chat-widget` will be documented in this file.

## 1.0.0 - 2025-01-XX

Initial release

### Features

- Floating AI chat widget for Filament v3 panels
- OpenAI integration with GPT-4o-mini support
- Conversation history persistence per user
- Knowledge base system with active/inactive entries
- MCP (Model Context Protocol) integration
- Customizable AI rules and guidelines via MCP Resources
- Beautiful, responsive UI with dark mode support
- Real-time typing indicators
- HTML formatted AI responses
- User authentication integration
- Token usage tracking
- Soft deletes for conversations and knowledge base
- Configurable AI model parameters (temperature, max tokens)
- Migration files for easy installation

### Architecture

- Clean separation of concerns using MCP pattern
- Eloquent models for database interactions
- Livewire components for reactive UI
- Service classes for business logic
- Resource pattern for context management
