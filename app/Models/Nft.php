<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function classes() {

        return $this->hasMany(Classes::class);
    }
}
