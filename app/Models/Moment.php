<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Moment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];


        //To create the corresponding folder each time a Moment is created. 
        public static function boot()
        {
            parent::boot();
            self::created(function ($moment) {
                $folderName = "/public/moments/{$moment->id}";
                Storage::makeDirectory($folderName);
            });
        }



    //Relations 

    public function user()
    {
        return $this->belongsTo(User::class, );
    }

    
    public function multimedia()
    {
        return $this->hasMany(Multimedia::class);
    }


}
