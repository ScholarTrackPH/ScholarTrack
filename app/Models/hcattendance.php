<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hcattendance extends Model
{
    use HasFactory;

    protected $table = 'hcattendance';

    protected $primaryKey = 'hcaid';

    protected $fillable = [
        'hcid',
        'caseCode',
        'timein',
        'timeout',
        'tardinessduration',
        'hcastatus'
    ];

    // Define inverse relationship to account
    public function user()
    {
        return $this->belongsTo(User::class, 'caseCode', 'caseCode');
    }

    public function basicinfo()
    {
        return $this->hasOne(ScBasicInfo::class, 'caseCode', 'caseCode');
    }

    public function humanitiesclass()
    {
        return $this->belongsTo(humanitiesclass::class, 'hcid', 'hcid');
    }

    public function lte()
    {
        return $this->hasOne(lte::class, 'conditionid', 'hcaid');
    }
}
