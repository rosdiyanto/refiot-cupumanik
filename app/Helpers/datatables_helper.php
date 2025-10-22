<?php

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\HTTP\RequestInterface;

/**
 * Helper server-side DataTables.
 * Support: search, order, paging, custom column (callback).
 */

if (!function_exists('datatable_response')) {
    /**
     * @param BaseBuilder $builder Query builder CI4
     * @param RequestInterface $request Objek request (biasanya $this->request)
     * @param array|null $customColumns Array kolom custom ['nama_kolom' => function($row){...}]
     * @return array Response JSON DataTables
     */
    function datatable_response(BaseBuilder $builder, RequestInterface $request, ?array $customColumns = [])
    {
        $draw   = (int) $request->getGetPost('draw');
        $start  = (int) $request->getGetPost('start');
        $length = (int) $request->getGetPost('length');
        $search = $request->getGetPost('search')['value'] ?? '';

        // Ambil nama tabel dan kolom
        $table  = $builder->getTable();
        $fields = $builder->get()->getFieldNames();

        // Hitung total data
        $recordsTotal = $builder->countAllResults(false);

        // Reset builder untuk query berikutnya
        $builder->resetQuery();
        $builder = $builder->db()->table($table);

        // Filtering (search)
        if (!empty($search)) {
            $builder->groupStart();
            foreach ($fields as $field) {
                $builder->orLike($field, $search);
            }
            $builder->groupEnd();
        }

        // Hitung total setelah filter
        $recordsFiltered = $builder->countAllResults(false);
        $builder->resetQuery();
        $builder = $builder->db()->table($table);

        // Apply search lagi ke data utama
        if (!empty($search)) {
            $builder->groupStart();
            foreach ($fields as $field) {
                $builder->orLike($field, $search);
            }
            $builder->groupEnd();
        }

        // Sorting
        $order   = $request->getGetPost('order');
        $columns = $request->getGetPost('columns');
        if (!empty($order) && !empty($columns)) {
            foreach ($order as $ord) {
                $colIndex = $ord['column'];
                $colName  = $columns[$colIndex]['data'];
                $dir      = $ord['dir'] ?? 'asc';
                if (in_array($colName, $fields)) {
                    $builder->orderBy($colName, $dir);
                }
            }
        }

        // Paging
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        // Ambil data
        $data = $builder->get()->getResultArray();

        // Tambahkan kolom custom (misalnya tombol Aksi)
        if (!empty($customColumns)) {
            foreach ($data as &$row) {
                foreach ($customColumns as $key => $callback) {
                    $row[$key] = $callback((object) $row);
                }
            }
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];
    }
}
