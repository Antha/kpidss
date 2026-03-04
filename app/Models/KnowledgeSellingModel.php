<?php

namespace App\Models;

use CodeIgniter\Model;

class KnowledgeSellingModel extends Model
{
    protected $table            = 'knowledge_selling';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    // Kolom yang boleh diisi
    protected $allowedFields    = [
        'id_user',
        'pic',
        'location_name',
        'datetime'
    ];

    // Kalau mau pakai timestamps otomatis, aktifkan ini
    protected $useTimestamps = false; // karena tabelmu belum ada created_at/updated_at
}