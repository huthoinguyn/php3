<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model{

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
        'summary',
        'description',
        'featured',
        'status',
        'category_id',
        'brand_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    : BelongsTo{
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand()
    : BelongsTo{
        return $this->belongsTo(Brand::class);
    }
}
