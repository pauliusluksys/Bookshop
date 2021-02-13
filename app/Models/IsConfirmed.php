<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsConfirmed extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'message',
        'book_id',
        'is_confirmed_type_id',
    ];

    public function isConfirmedType()
    {
        return $this->belongsTo(isConfirmedType::class);
    }

     public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
