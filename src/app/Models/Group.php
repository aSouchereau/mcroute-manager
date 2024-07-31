<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "image_url"
    ];

    protected $guarded = [
        "enabled"
    ];

    public function routes() {
        return $this->hasMany(Route::class);
    }
}
