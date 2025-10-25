<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; // UUID, bukan auto increment
    protected $returnType       = 'array';
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'id',
        'nip_baru',
        'nik',
        'nama_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'status_kepegawaian',
        'jab_type',
        'nama_golongan',
        'nama_pangkat',
        'kode_unor',
        'kode_uk',
        'nama_unor',
        'unit_kerja',
        'jabatan',
        'nama_ese',
        'kelas_jabatan',
        'jenjang_pendidikan',
        'created_at',
        'updated_at'
    ];

    // Otomatis isi kolom created_at dan updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';

    // Callback sebelum insert
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

    /**
     * Upsert data berdasarkan nip_baru
     *
     * @param array $data
     * @return bool|int
     */
    public function upsert(array $data)
    {
        if (empty($data['nip_baru'])) {
            throw new \InvalidArgumentException("NIP baru harus diisi untuk upsert.");
        }

        $existing = $this->where('nip_baru', $data['nip_baru'])->first();

        if ($existing) {
            $data['id'] = $existing['id']; // gunakan ID yang sudah ada
            return $this->update($existing['id'], $data);
        } else {
            return $this->insert($data); // insert baru, UUID otomatis
        }
    }
}
