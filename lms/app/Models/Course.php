<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'seo_url',
        'faculty',
        'category',
        'status',
        'published_at'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
