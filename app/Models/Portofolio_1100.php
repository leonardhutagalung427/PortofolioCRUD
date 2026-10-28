<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio_1100 extends Model
{
    protected $table = 'portofolio_1100s';
    protected $guarded = [];

    public function skill()
    {
        return $this->belongsTo(Skill_1100::class, 'skill_id');
    }
}
