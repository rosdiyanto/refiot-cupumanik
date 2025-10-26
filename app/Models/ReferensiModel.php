<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ReferensiModel extends Model
{
    protected $table            = 'referensi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id',
        'code_reff',
        'group_reff',
        'nama_reff',
        'value_reff',
        'order',
    ];

    // Aktifkan timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Hook untuk generate UUID v4 otomatis
    protected $beforeInsert = ['generateUUID'];

    protected function generateUUID(array $data)
    {
        if (empty($data['data']['id'])) {
            $data['data']['id'] = Uuid::uuid4()->toString();
        }
        return $data;
    }
}
