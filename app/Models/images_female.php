<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images_female extends Model
{
    use HasFactory;

    protected $fillable=[
        'imageF',
        'classes_id',
    ];

    public function classes() {

        return $this->belongsTo(Classes::class);
    }
}
