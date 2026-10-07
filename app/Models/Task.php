<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'deadline',
        'status',
        'favorite',
    ];

    protected $casts = [
        'deadline' => 'date',
        'favorite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
