<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'posts';
    public const FIELD_ID   = 'post_id';

    protected $primaryKey = self::FIELD_ID;
    protected $table      = self::TABLE_NAME;

    protected $visible = [
        'post_id',
        'topic'
    ];

    protected $fillable = [
      'topic'
    ];

    protected $with = [
        'comments'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, self::FIELD_ID);
    }
}
