<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'area',
        'city',
        'address',
        'mobile_no',
        'category',
        'sub_category',
        'is_duplicate',
        'merged_into_id'
    ];

    public function mergedInto()
    {
        return $this->belongsTo(Listing::class, 'merged_into_id');
    }

    public function duplicates()
    {
        return $this->hasMany(Listing::class, 'merged_into_id');
    }
}
