<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'is_spent',
        'user_id',
    ];

    protected $appends = [
        'time',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTimeAttribute()
    {
       return (new Carbon($this->created_at))->toDateString();
    }

    public function getIsSpentAttribute($value)
    {
        return $value == 'true';
    }
}
