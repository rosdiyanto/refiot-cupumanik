<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class RfidModel extends Model
{
    protected $table            = 'rfid';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id',
        'kode_rfid',
        'status',
        'id_pegawai',
        'tanggal_daftar',
        'keterangan',
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $dateFormat       = 'datetime';
    protected $beforeInsert     = ['generateUUID'];

    /**
     * Generate UUID otomatis sebelum insert
     */
    protected function generateUUID(array $data)
    {
        if (empty($data['data']['id'])) {
            $data['data']['id'] = Uuid::uuid4()->toString();
        }
        return $data;
    }

    public function getWithPegawai()
    {
        $sql = "
            SELECT 
                rfid.id,
                rfid.kode_rfid,
                COALESCE(pegawai.nama_pegawai, 'Belum mapping') AS nama_pegawai,
                rfid.status,
                rfid.tanggal_daftar,
                rfid.keterangan
            FROM rfid
            LEFT JOIN pegawai ON pegawai.id = rfid.id_pegawai
        ";

        return $this->db->query($sql)->getResultArray();
    }
}
