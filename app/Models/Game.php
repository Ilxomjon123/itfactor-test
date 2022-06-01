<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function histories()
    {
        return $this->hasMany(GameHistory::class)->oldest();
    }

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }

    public function homeClub()
    {
        return $this->belongsTo(Club::class, 'home');
    }

    public function awayClub()
    {
        return $this->belongsTo(Club::class, 'away');
    }
}
