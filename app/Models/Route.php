<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        "nickname",
        "domain_name",
        "host",
        "group_id",
        "enabled"
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
