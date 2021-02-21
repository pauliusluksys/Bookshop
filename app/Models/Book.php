<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Scope;
class Book extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    

    protected $fillable = [
        'title',
        'description',
        'price',
        'discount',
        'user_id',
        
    ];
    protected $perPage= 25;

    public function confirmation()
    {
        return $this->hasOne(Confirmation::class);
    }
    public function user()
    {
         return $this->belongsTo(User::class);
    }
     public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }	
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function BookReports()
    {
        return $this->hasMany('App\Models\BookReport');
    }
      public function scopeConfirmed($query)
    {
        return $query->whereHas('confirmation', function($q){
        $q->where('type', '=', 'Accepted');
        });
    }
    
}
