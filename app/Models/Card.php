<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = "cards";
    
    protected $fillable = [
        'user_id',
        'serial_number',
        'value',
        'is_used',
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
