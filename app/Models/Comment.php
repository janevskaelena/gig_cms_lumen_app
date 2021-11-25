<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public const TABLE_NAME = 'comments';
    public const FIELD_ID   = 'comment_id';

    protected $primaryKey = self::FIELD_ID;
    protected $table      = self::TABLE_NAME;

    protected $fillable = [
        'post_id',
        'content',
        'abbreviation',
    ];

    protected $visible = [
        'comment_id',
        'post_id',
        'content'.
        'abbreviation',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, Post::FIELD_ID, 'comment_id');
    }


}
