<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spells extends Model
{
    use HasFactory;

    protected $fillable = ['title','discription', 'image', 'classes_id', 'slug'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function classes() {

        return $this->belongsTo(Classes::class);
    }
}
