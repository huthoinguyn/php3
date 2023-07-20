<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model{

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'thumbnail',
        'body',
        'active',
        'published_at',
        'user_id',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    /**
     * Summary of user
     *
     * @return BelongsTo
     */
    public function user()
    : BelongsTo{
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of category
     *
     * @return BelongsTo
     */
    public function category()
    : BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function getFormattedDate(){
        return $this->published_at->format('F jS Y');
    }

    public function shortBody(){
        return Str::words(strip_tags($this->body));
    }

    public function getThumbnail(){
        if (str_starts_with($this->thumbnail, 'http')){
            return $this->thumbnail;
        }

        return '/storage/' . $this->thumbnail;
    }
}
