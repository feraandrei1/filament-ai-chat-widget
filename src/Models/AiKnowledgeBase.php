<?php

namespace Feraandrei1\FilamentAiChatWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AiKnowledgeBase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'active',
        'order_column',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order_column' => 'integer',
    ];

    public static function getActiveKnowledgeBases(): array
    {
        return self::where('active', true)
            ->orderBy('order_column')
            ->get()
            ->map(fn($aiKnowledgeBase) => [
                'role' => 'system',
                'content' => $aiKnowledgeBase->content,
            ])
            ->toArray();
    }
}
