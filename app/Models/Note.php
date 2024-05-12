<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'notes';
    protected $fillable = [
        "user_id",
        "uuid",
        "title",
        "content"
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }
}
