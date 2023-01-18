<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'status',
        'points',
        'is_confirmed',
        'last_date',
        "confirmed_at"
    ];

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hints(){
        return $this->hasMany(Hint::class);
    }

    public function complete(){
        return $this->update(["status" => "completed"]);
    }

    public function confirm(){
        date_default_timezone_set("Africa/Cairo");
        return $this->update([
            "is_confirmed" => true,
            "confirmed_at" => date('Y-m-d H:i:s', time())
        ]);
    }

}
