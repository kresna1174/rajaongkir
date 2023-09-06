<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';
    protected $fillable = [
        'city_id',
        'province_id',
        'type',
        'city_name',
        'postal_code'
    ];
    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
}
