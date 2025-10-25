<?php

use CodeIgniter\HTTP\IncomingRequest;

if (!function_exists('datatable_response_array')) {
    /**
     * Datatable helper untuk data array.
     * Support: search, order, pagination, custom column.
     */
    function datatable_response_array(array $data, IncomingRequest $request, ?array $customColumns = [])
    {
        // Ambil parameter DataTables
        $draw   = (int) ($request->getGetPost('draw') ?? 1);
        $start  = (int) ($request->getGetPost('start') ?? 0);
        $length = (int) ($request->getGetPost('length') ?? -1);
        $search = $request->getGetPost('search')['value'] ?? '';
        $order  = $request->getGetPost('order') ?? [];
        $columns = $request->getGetPost('columns') ?? [];

        $recordsTotal = count($data);

        // 🔍 Filtering (search global)
        if ($search !== '') {
            $data = array_filter($data, function ($row) use ($search) {
                foreach ($row as $value) {
                    if (stripos((string) $value, $search) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        $recordsFiltered = count($data);

        // 🔽 Sorting
        if (!empty($order) && !empty($columns)) {
            foreach ($order as $ord) {
                $colIndex = $ord['column'];
                $colName  = $columns[$colIndex]['data'] ?? null;
                $dir      = strtolower($ord['dir'] ?? 'asc');

                if ($colName && isset($data[0][$colName])) {
                    usort($data, function ($a, $b) use ($colName, $dir) {
                        if ($a[$colName] == $b[$colName]) return 0;
                        return ($dir === 'asc')
                            ? ($a[$colName] <=> $b[$colName])
                            : ($b[$colName] <=> $a[$colName]);
                    });
                }
            }
        }

        // 📄 Pagination
        if ($length > 0) {
            $data = array_slice($data, $start, $length);
        }

        // ⚙️ Custom Columns
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
            'data' => array_values($data),
        ];
    }
}
