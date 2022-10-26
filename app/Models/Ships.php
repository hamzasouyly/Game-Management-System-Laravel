<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ships extends Model
{
    use HasFactory;

    protected $fillable = ['title','discription', 'background', 'type', 'slug', 'equipment_id'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function equipment() {

        return $this->belongsTo(Equipment::class);
    }
}
