<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; // UUID bukan auto increment
    protected $returnType       = 'array';
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'id',
        'nama',
        'nip',
        'id_group',
        'jabatan',
        'golongan',
        'tanggal_lahir',
        'alamat',
        'created_at',
        'updated_at'
    ];

    // Otomatis isi kolom created_at dan updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';

    // Callback
    protected $beforeInsert = ['generateUUID'];

    /**
     * Generate UUID v4 otomatis sebelum insert data baru
     */
    protected function generateUUID(array $data)
    {
        if (empty($data['data']['id'])) {
            $data['data']['id'] = Uuid::uuid4()->toString(); // UUID v4
        }
        return $data;
    }
}
