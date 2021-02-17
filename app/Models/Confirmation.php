<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'message',
        'book_id',
        'confirmation_type_id',
    ];


     public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
