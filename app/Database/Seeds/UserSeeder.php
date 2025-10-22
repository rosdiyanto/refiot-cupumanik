<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();

        // Buat user baru
        $user = new User([
            'username' => 'user',
            'email'    => 'user@user.com',
            'password' => 'ayamireng', // akan otomatis di-hash oleh Shield
        ]);

        $users->save($user);

        // Ambil user yang baru dibuat
        $user = $users->findById($users->getInsertID());

        // Tambahkan ke grup user
        $user->addGroup('user');

        echo "✅ User biasa berhasil dibuat.\n";
    }
}
