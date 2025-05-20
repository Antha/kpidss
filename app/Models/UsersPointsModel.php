<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersPointsModel extends Model
{
    protected $table = 'users_points'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    protected $allowedFields = [
        'user_id',
        'point',
        'point_category',
        'periode',
        'batch'
    ]; // Kolom yang dapat diisi
}
