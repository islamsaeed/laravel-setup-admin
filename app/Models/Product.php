<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{

    protected $fillable = ['name', 'updated_at', 'category_id', 'created_at'];
    use HasTranslations;
    public $translatable = ['name'];

    protected $table = 'products';

    public $timestamps = true;

    public function category()
    {

        return $this->belongsTo(Category::class);
    }
}
