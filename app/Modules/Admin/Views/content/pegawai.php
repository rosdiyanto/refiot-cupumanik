<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            Pegawai
                        </h1>
                        <div class="page-header-subtitle">Daftar pegawai yang ada di REFIOT</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-body">
                <table id="tblDatatables" class="display">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tipe Jenis</th>
                            <th>Nama Jabatan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        let table = $('#tblDatatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('admin/pegawai/getdata') ?>',
                type: 'GET'
            },
            columns: [{
                    data: 'nip_baru'
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama_pegawai'
                },
                {
                    data: 'status_kepegawaian'
                },
                {
                    data: 'jab_type'
                },
                {
                    data: 'jabatan'
                }
            ]
        });

        // Matikan search otomatis bawaan DataTables
        $('#tblDatatables_filter input').unbind();

        // Jalankan search hanya jika tekan Enter
        $('#tblDatatables_filter input').on('keypress', function(e) {
            if (e.which === 13) { // 13 = Enter key
                table.search(this.value).draw();
            }
        });
    });
</script>