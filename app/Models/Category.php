<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model{

    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'status', 'type'];

    /**
     * @return HasMany
     */
    public function products()
    : HasMany{
        return $this->hasMany(Product::class);
    }

    public static function getTypeCategory($type)
    : Builder{
        return self::query()
                   ->where('type', '=', $type)
                   ->where('status', '=', 1);
    }
}
