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
     */
    protected $visible = [
        'post_id',
        'topic',
        'comments'
    ];

    /**
     * set fillable fields
     */
    protected $fillable = [
      'topic'
    ];

    protected $relationWith = [
        'comments'
    ];

    /**
     * set fields for sorting
     * @var array
     */
    protected $sortables = [
        'post_id',
        'topic',
        'created_at',
        'updated_at'
    ];

    /**
     * set string fields for filtering
     * @var array
     */
    protected $likeFilterFields = [
        'topic'
    ];

    /**
     * set boolean fields for filtering
     * @var array
     */
    protected $equalsFilterFields = [
        'post_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'topic' => 'required|string'
        ];
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, self::FIELD_ID, 'post_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function(Post $post) {
            $post->comments()->delete();
        });
    }
}
