<?php

namespace App\Models;

use CodeIgniter\Model;

class DatatablesModel extends Model
{
    protected $table         = 'datatables';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nama', 'email', 'alamat'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
