<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{

    protected $fillable = [
        'name','email','website','phone','linkedin','address','category','facebook',
        'instagram','whatsapp','other','description','status',
    ];

    use HasFactory;
}



?>