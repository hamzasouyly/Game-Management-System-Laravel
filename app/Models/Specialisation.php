<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialisation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function classes() {

        return $this->belongsToMany(Classes::class, 'classes_specialisations');
    }
}
