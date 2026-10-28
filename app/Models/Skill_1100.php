<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill_1100 extends Model
{
    protected $table = 'skill_1100s';
    protected $guarded = [];

    public function portofolios()
    {
        return $this->hasMany(Portofolio_1100::class, 'skill_id');
    }
}
