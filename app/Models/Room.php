<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Room extends Model
{
    use HasFactory, Uuid;
    
    protected $fillable = [
        'room_name',
        'capacity',
        'description',
        'price',
        'image'
    ];

    protected $appends = ['imagedir'];

    public function getImagedirAttribute()
    {
        return asset('storage/RoomImage/' . $this->image);
    }
}
