<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected string $collection = 'vehicleTypes';
}
