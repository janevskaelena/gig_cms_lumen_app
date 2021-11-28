<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Relational;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sortable, Filterable, Relational;

    public const DEFAULT_LIMIT = 10;

    public const TABLE_NAME = 'posts';
    public const FIELD_ID   = 'post_id';

    protected $primaryKey = self::FIELD_ID;
    protected $table      = self::TABLE_NAME;

    /**
     * set visible fields
     * @var string[]
     */
    protected $visible = [
        'post_id',
        'topic',
        'comments'
    ];

    /**
     * set fillable fields
     * @var string[]
     */
    protected $fillable = [
      'topic'
    ];

    /**
     * set relationship with fields
     * @var string[]
     */
    protected $relationWith = [
        'comments'
    ];

    /**
     * set fields for sorting
     * @var string[]
     */
    protected $sortables = [
        'post_id',
        'topic',
        'created_at',
        'updated_at'
    ];

    /**
     * set string fields for filtering
     * @var string[]
     */
    protected $likeFilterFields = [
        'topic'
    ];

    /**
     * set equals fields for filtering
     * @var string[]
     */
    protected $equalsFilterFields = [
        'post_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(Request $request)
    {
        return [
            'topic' => 'required|string|min:1'
        ];
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, self::FIELD_ID, 'post_id');
    }

    /**
     *
     * event listener on deleting post
     *
     */
    public static function boot() {
        parent::boot();

        static::deleting(function(Post $post) {
            $post->comments()->delete();
        });
    }
}
