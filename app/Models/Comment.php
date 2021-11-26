<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Sortable, Filterable;

    public const DEFAULT_LIMIT = 10;

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
        'content',
        'abbreviation',
    ];

    /**
     * set fields for sorting
     * @var array
     */
    protected $sortables = [
        'comment_id',
        'post_id',
        'content',
        'abbreviation',
        'created_at',
        'updated_at'
    ];

    /**
     * set string fields for filtering
     * @var array
     */
    protected $likeFilterFields = [
        'content',
        'abbreviation'
    ];

    /**
     * set boolean fields for filtering
     * @var array
     */
    protected $equalsFilterFields = [
        'post_id',
        'comment_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'post_id' => 'required|int',
            'content' => 'string'
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, Post::FIELD_ID, 'comment_id');
    }


}
