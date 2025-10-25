<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Users List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="user-management-groups-list.html">
                            <i class="me-1" data-feather="users"></i>
                            Manage Groups
                        </a>
                        <a class="btn btn-sm btn-light text-primary" href="user-management-add-user.html">
                            <i class="me-1" data-feather="user-plus"></i>
                            Add New User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
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
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#tblDatatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('datatables/data') ?>',
                type: 'GET'
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'email'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>