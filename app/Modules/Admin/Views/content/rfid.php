<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="credit-card"></i></div>
                            RFID
                        </h1>
                        <div class="page-header-subtitle">Daftar semua kartu RFID yang sudah di daftarkan</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        id="tblDatatables"
                        class="display nowrap table table-striped table-bordered">
                        <thead class="table-custom">
                            <tr>
                                <th>Kode RFID</th>
                                <th>Status</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal Daftar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
                url: '<?= site_url('admin/rfid/getdata') ?>',
                type: 'GET'
            },
            columns: [{
                    data: 'kode_rfid'
                },
                {
                    data: 'status'
                },
                {
                    data: 'nama_pegawai'
                },
                {
                    data: 'tanggal_daftar'
                },
                {
                    data: 'keterangan'
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