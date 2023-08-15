<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = "routes";

    protected $fillable = [
        "nickname",
        "domain_name",
        "host",
        "group_id"
    ];

    protected $guarded = [
      "enabled"
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
