<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserProject extends Model
{
    use HasFactory;
    use HasUuids;


    protected $fillable = [
        'name',
        'user_id',
    ];

    public function uniqueIds()
    {
        return ['id'];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
