<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Branch extends Model
{
    use HasFactory  ,SoftDeletes ,LogsActivity ;

    protected $fillable = [
    'branch_Name',
    'address',
    'phone',
    'start_day',
    'end_day',
    'opening_hours',
    'opening_hours_from',
    'opening_hours_to',
    'lat',
    'lng',
    'status',
];

public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
    ->logOnly(['Name', 'Description']);
}

}
