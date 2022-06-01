<?php

namespace App\Traits;

use App\Models\PersonalInfo;

trait CommonUser
{
  protected $append = ['full_name'];
  public function personal_info()
  {
    return $this->belongsTo(PersonalInfo::class);
  }

  public function getFullNameAttribute()
  {
    return "{$this->firstname} {$this->lastname}";
  }
}
