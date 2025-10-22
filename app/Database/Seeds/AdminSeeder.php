<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();

        // Buat user baru
        $user = new User([
            'username' => 'admin',
            'email'    => 'admin@admin.com',
            'password' => 'ayamireng', // akan otomatis di-hash oleh Shield
        ]);

        $users->save($user);

        // Ambil user yang baru dibuat
        $user = $users->findById($users->getInsertID());

        // Tambahkan ke grup admin
        $user->addGroup('admin');

        echo "✅ User admin berhasil dibuat.\n";
    }
}
