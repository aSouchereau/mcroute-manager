<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        "nickname",
        "domain",
        "host",
        "group_id"
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
