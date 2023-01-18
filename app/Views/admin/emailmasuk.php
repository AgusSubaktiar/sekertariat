<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Email Masuk</h1>

    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Email Masuk<strong><?= session()->getFlashdata('message'); ?></strong>
        </div>

        <script>
            $(".alert").alert();
        </script>
    <?php endif; ?>

    <divc class="row">
        <div class="col-md-6">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }
            ?>
        </div>
    </divc>

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahEmailMasuk">
                                    <i class="fa fas-plus">Tambah Data</i>
                                </button>
                            </h4>
                            <div class="card-header-form">
                                <form action="" method="post">
                                    <div class="input-group">
                                        <input type="text" name="keyword" value="" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-md">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Surat</th>
                                        <th>No Memo</th>
                                        <th>Kepada</th>
                                        <th>Perihal</th>
                                        <th>Kode Proyek</th>
                                        <th>Nama Proyek</th>
                                        <th>Tembusan</th>
                                        <th>ordner</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

                        <script>
                            $(document).ready(function() {
                                $('#myTable').Datatable({
                                    "procesing": true,
                                    "serverSide": true,
                                    "order": [],
                                    "ajax": {
                                        "url": "<?= base_url('EmailMasuk/emailAjax'); ?>",
                                        "type": "POST"
                                    },
                                    colums: [{
                                            data: 'null'
                                        },
                                        {
                                            data: 'tgl_emailmasuk'
                                        },
                                        {
                                            data: 'no_emailmasuk'
                                        },
                                        {
                                            data: 'kepada'
                                        },
                                        {
                                            data: 'perihal'
                                        },
                                        {
                                            data: 'kode_proyek'
                                        },
                                        {
                                            data: 'nama_proyek'
                                        },
                                        {
                                            data: 'tembusan'
                                        },
                                        {
                                            data: 'ordner'
                                        },
                                    ],
                                });
                            });
                        </script>
</section>
<?= $this->endSection() ?>