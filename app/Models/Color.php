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

}
