<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $tables = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'category_id', 'photo'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
