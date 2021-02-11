<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsConfirmedType extends Model
{
    use HasFactory;




    public function isConfirmed()
    {
        return $this->hasMany(IsConfirmed::class);
    }
}
