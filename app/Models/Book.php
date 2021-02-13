<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Book extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = [
        'title',
        'description',
        'price',
        
    ];


    public function isConfirmeds()
    {
        return $this->hasOne(IsConfirmed::class);
    }
    public function user()
    {
         return $this->belongsTo(User::class);
    }
     public function author()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
}
