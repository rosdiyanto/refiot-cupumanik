<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Sedikit styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        a.btn {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }
        .btn-primary { background-color: #007bff; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; }
        .btn:hover { opacity: 0.85; }
        h2 { margin-bottom: 20px; }
        table.dataTable { width: 100% !important; }
    </style>
</head>
<body>

    <h2>Daftar Pengguna</h2>

    <a href="<?= site_url('datatables/create') ?>" class="btn btn-primary">+ Tambah Pengguna</a>
    <br><br>

    <table id="tblDatatables" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

    <script>
    $(document).ready(function() {
        $('#tblDatatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('datatables/data') ?>',
                type: 'GET'
            },
            columns: [
                { data: 'id' },
                { data: 'nama' },
                { data: 'email' },
                { data: 'alamat' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>

</body>
</html>
