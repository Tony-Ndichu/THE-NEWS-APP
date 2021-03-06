<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'url', 'abstract', 'read_status', 'image_url', 'author', 'publishedAt'];
}
