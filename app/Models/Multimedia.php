<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    //Relation
    
    public function moment()
    {
        return $this->belongsTo(Moment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
