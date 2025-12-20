<?php

namespace Feraandrei1\FilamentAiChatWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiConversation extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'user_id',
        'messages',

        'model',
        'temperature',
        'max_tokens',

        'tokens_used',
    ];

    protected $casts = [
        'messages' => 'array',
        'temperature' => 'decimal:2',
        'max_tokens' => 'integer',
        'tokens_used' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
}
