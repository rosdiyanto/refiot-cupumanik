<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class UnitKerjaModel extends Model
{
    protected $table            = 'unit_kerja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; // karena pakai UUID
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['id', 'kode_uk', 'unit_kerja'];

    // Callback sebelum insert untuk generate UUID hanya untuk id
    protected $beforeInsert = ['generateUUID'];

    protected function generateUUID(array $data)
    {
        if (empty($data['data']['id'])) {
            $data['data']['id'] = Uuid::uuid4()->toString();
        }
        return $data;
    }
}
