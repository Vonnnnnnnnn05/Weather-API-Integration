<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table         = 'cities';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['city_name', 'country'];
    protected $useTimestamps = true; // auto-fill created_at / updated_at
    protected $returnType    = 'array';

    // Simple validation rules
    protected $validationRules = [
        'city_name' => 'required|min_length[2]|max_length[100]',
        'country'   => 'permit_empty|alpha|exact_length[2]',
    ];
}
