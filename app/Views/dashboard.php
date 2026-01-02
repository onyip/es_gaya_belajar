<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <!-- Card 1 -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total Siswa</div>
                        </div>
                        <div class="h1 mb-3">125</div>
                        <div class="d-flex mb-2">
                            <div>Jumlah siswa terdaftar</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total Guru</div>
                        </div>
                        <div class="h1 mb-3">12</div>
                        <div class="d-flex mb-2">
                            <div>Jumlah guru aktif</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Pengunjung Hari Ini</div>
                        </div>
                        <div class="h1 mb-3">45</div>
                        <div class="d-flex mb-2">
                            <div>Total kunjungan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Status Sistem</div>
                        </div>
                        <div class="h1 mb-3 text-green">Aktif</div>
                        <div class="d-flex mb-2">
                            <div>Server berjalan normal</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>