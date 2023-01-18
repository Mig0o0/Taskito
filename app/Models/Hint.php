<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hint extends Model
{
    use HasFactory;

    protected $fillable = [
        "content",
        "is_image",
        "subtracted_points",
        "task_id",
        "is_opened"
    ];

    protected $attributes = [
        'is_opened' => false
     ];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
