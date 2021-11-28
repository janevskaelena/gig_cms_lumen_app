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

    /**
     * set fillable fields
     * @var string[]
     */
    protected $fillable = [
        'post_id',
        'content',
        'abbreviation'
    ];

    /**
     * set visible fields
     * @var string[]
     */
    protected $visible = [
        'comment_id',
        'post_id',
        'content',
        'abbreviation',
    ];

    /**
     * set fields for sorting
     * @var string[]
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
     * @var string[]
     */
    protected $likeFilterFields = [
        'content',
        'abbreviation'
    ];

    /**
     * set equals fields for filtering
     * @var string[]
     */
    protected $equalsFilterFields = [
        'post_id',
        'comment_id'
    ];


    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return string[]
     */
    public function rules(Request $request): array
    {
        return [
            'post_id' => 'required|int|exists:posts,post_id',
            'content' => 'required|string|min:1'
        ];
    }

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, Post::FIELD_ID, 'comment_id');
    }


}
