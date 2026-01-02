<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<style>
    /* Custom Animations and Styles */
    .fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table-hover tbody tr {
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .table-hover tbody tr:hover {
        transform: scale(1.005);
        background-color: rgba(32, 107, 196, 0.03) !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        z-index: 1;
        position: relative;
    }

    /* Modal transition */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
        transform: scale(0.9);
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>

<div class="page-header d-print-none fade-in-up">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Master Data
                </div>
                <h2 class="page-title">
                    <!-- Download SVG icon from http://tabler-icons.io/i/school -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                    </svg>
                    &nbsp;
                    Gaya Belajar
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-report" onclick="resetForm()">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body fade-in-up" style="animation-delay: 0.1s;">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-gaya-belajar" class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama Gaya</th>
                                <th>Definisi</th>
                                <th>Solusi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Gaya Belajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-gaya-belajar">
                <div class="modal-body">
                    <input type="hidden" name="id_gaya" id="id_gaya">
                    <div class="mb-3">
                        <label class="form-label">Kode Gaya</label>
                        <input type="text" class="form-control" name="kode_gaya" id="kode_gaya" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Gaya</label>
                        <input type="text" class="form-control" name="nama_gaya" id="nama_gaya" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Definisi</label>
                        <textarea class="form-control" name="definisi" id="definisi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Solusi</label>
                        <textarea class="form-control" name="solusi" id="solusi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var table;
    $(document).ready(function () {
        table = $('#table-gaya-belajar').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('gaya-belajar/list') ?>',
                type: 'POST'
            },
            columns: [
                { data: 'id_gaya' },
                { data: 'kode_gaya' },
                { data: 'nama_gaya' },
                { data: 'definisi' },
                { data: 'solusi' },
                { data: 'action', orderable: false }
            ],
            responsive: true
        });

        $('#form-gaya-belajar').on('submit', function (e) {
            e.preventDefault();
            var id = $('#id_gaya').val();
            var url = id ? '<?= site_url('gaya-belajar/update/') ?>' + id : '<?= site_url('gaya-belajar/create') ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.status == 'success') {
                        $('#modal-report').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Berhasil', response.message, 'success');
                    }
                }
            });
        });
    });

    function resetForm() {
        $('#form-gaya-belajar')[0].reset();
        $('#id_gaya').val('');
        $('.modal-title').text('Tambah Gaya Belajar');
    }

    function editData(id) {
        $.get('<?= site_url('gaya-belajar/show/') ?>' + id, function (data) {
            $('#id_gaya').val(data.id_gaya);
            $('#kode_gaya').val(data.kode_gaya);
            $('#nama_gaya').val(data.nama_gaya);
            $('#definisi').val(data.definisi);
            $('#solusi').val(data.solusi);
            $('.modal-title').text('Edit Gaya Belajar');
            $('#modal-report').modal('show');
        }, 'json');
    }

    function deleteData(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('gaya-belajar/delete/') ?>' + id,
                    type: 'DELETE', // Method delete often assumes content-type issues in some configs, POST might be safer if not configured, but CI4 supports DELETE
                    success: function (response) {
                        if (response.status == 'success') {
                            table.ajax.reload();
                            Swal.fire('Terhapus!', response.message, 'success');
                        }
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection() ?>