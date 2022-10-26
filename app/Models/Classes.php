<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['title','discription','image','slug', 'nft_id'];
    protected $with = ['images_male', 'images_female', 'roles', 'specialisation', 'spells'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function images_male(){
        return $this->hasMany(images_male::class);
    }
    
    public function images_female(){
        return $this->hasMany(images_female::class);
    }

    public function nft() {

        return $this->belongsTo(Nft::class);
    }

    public function roles() {

        return $this->hasMany(Roles::class);
    }

    public function specialisation() {

        return $this->hasMany(Specialisation::class);
    }

    public function spells() {

        return $this->hasMany(Spells::class);
    }

    public function sex() {

        return $this->hasMany(Sex::class);
    }
}
