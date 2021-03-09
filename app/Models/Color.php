<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Color extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $table = 'colors';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function colors()
    {
        return $this->belongsToMany('App\Models\ProductImg', 'color_productImgs', 'color_id', 'product_img_id');
    }
}
