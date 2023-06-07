<?php

namespace App\Models;

use App\Enums\Notices\NoticesDivision;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Notice extends BaseModel
{
    use HasFactory;

    protected $appends = [
        'divisionLabel',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('notice_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('close_date', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function getDivisionLabelAttribute($value)
    {
        return $this->enumLabel($this->division, "App\Enums\Notices\NoticesDivision");
    }
}
