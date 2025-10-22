<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class TestEmail extends Controller
{
    public function index()
    {
        // Load library email
        $email = Services::email();

        // Set pengirim
        $email->setFrom('admin@rosdiyanto.my.id', 'Rosdiyanto');

        // Set penerima
        $email->setTo('rosdiyantodede@gmail.com'); // ganti dengan email tujuan

        // Subject
        $email->setSubject('Test Email dari CI4');

        // Isi email
        $email->setMessage('Ini adalah email percobaan untuk cek konfigurasi SMTP.');

        // Kirim email
        if ($email->send()) {
            echo 'Email berhasil dikirim!';
        } else {
            // Jika gagal, tampilkan debugger
            echo 'Email gagal dikirim!<br>';
            echo $email->printDebugger(['headers', 'subject', 'body', 'smtp']);
        }
    }
}
