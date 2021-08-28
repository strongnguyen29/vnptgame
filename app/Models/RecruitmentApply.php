<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruitment_id',
        'full_name',
        'email',
        'phone',
        'position',
        'file_cv'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recruitment() {
        return $this->belongsTo(Recruitment::class);
    }
}
