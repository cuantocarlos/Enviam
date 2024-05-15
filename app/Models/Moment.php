<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Moment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];


        //Para crear carpetas 
        public static function boot()// for each moment create one folder for the media
        {
            parent::boot();
    
            self::created(function ($moment) {
                // Crear la carpeta para el nuevo modelo multimedia
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
