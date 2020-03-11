<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    protected $dates = [
        'edited_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($comment) {
            $comment->edited_at = Carbon::now();
        });
    }

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comment's children
     */
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')
            ->orderBy('created_at', 'desc');;
    }
}
