<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class Post
 * @package App\Models
 * @property-read string title
 * @property-read string sub_title
 * @property-read string content
 * @property-read int author_id
 * @property-read User author
 */
class Post extends BaseModel
{
    protected $fillable = [
        'title', 'sub_title', 'author_id',
        'content',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
