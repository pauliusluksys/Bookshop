<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReport extends Model
{
    use HasFactory;

    protected $fillable=[
    	'text',
    ];

    public function user()
    {
         return $this->belongsTo(User::class);
    }
    public function book()
    {
         return $this->belongsTo(Book::class);
    }
}
