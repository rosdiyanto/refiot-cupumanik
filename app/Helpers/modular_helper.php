<?php

if (!function_exists('module_view')) {

    /**
     * Load view dari modul tertentu (tidak ada default modul)
     *
     * @param string $view   Nama view relatif di modul (misal 'dashboard', 'partials/header')
     * @param string $module Nama modul (misal 'Admin', 'User') — wajib diisi
     * @param array  $data   Data yang dikirim ke view
     * @param array  $options Opsi tambahan untuk view (CI4 4.6+)
     *
     * @return string
     * @throws \Exception Jika file view tidak ditemukan
     */
    function module_view(string $view, string $module, array $data = [], array $options = []): string
    {
        $path = APPPATH . "Modules/$module/Views/$view.php";

        if (!file_exists($path)) {
            throw new \Exception("View '$view' tidak ditemukan di modul '$module' pada $path");
        }

        return view("Modules\\$module\\Views\\$view", $data, $options);
    }
}
