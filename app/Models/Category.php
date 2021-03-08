<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    protected $fillable = ['name'];
    use HasTranslations;
    public $translatable = ['name'];
    // protected $table = 'categories';

    public $timestamps = true;

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
