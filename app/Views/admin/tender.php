<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Dokumen tender</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Dokumen tender<strong><?= session()->getFlashdata('message'); ?></strong>
        </div>

        <script>
            $(".alert").alert();
        </script>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }
            ?>
        </div>
    </div>

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-right">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modelTambahTender">
                                    <i class="fa fas-plus">Tambah Data</i>
                                </button>
                            </h4>
                            <!-- <div class="card-header-form">
                                <form action="" method="post">
                                    <div class="input-group">
                                        <input type="text" name="keyword" value="" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <!-- <div class="table-responsive"> -->
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Proyek</th>
                                        <th>Tanggal Tender</th>
                                        <th>File Tender</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    // $no = 1 + (10 * ($page - 1));
                                    $no = 1;
                                    foreach ($tender as $row) : ?>
                                        <tr>
                                            <td scope"row"><?= $no; ?></td>
                                            <td><?= $row['nama_proyek']; ?></td>
                                            <td><?= $row['tgl_tender']; ?></td>
                                            <td><?= $row['filetender']; ?></td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#modelUbahTender" id="btn-editender" class="btn btn-sm btn-warning" data-id="<?= $row['id_tender']; ?>" data-namaProyek="<?= $row['nama_proyek']; ?>" data-tgl_tender="<?= $row['tgl_tender']; ?>" data-filetender="<?= $row['filetender']; ?>"> <i class="fa fa-edit"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#modelHapusTender" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#modelDownloadTender" class="btn btn-sm btn-success" data-id="<?= $row['id_tender']; ?>" data-filetender="<?= $row['filetender']; ?>"> <i class="fa fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="modelTambahTender">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Tender/addtender'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="nama_proyek"></label>
                        <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" placeholder="Masukan Tanggal Memo Masuk">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_tender"></label>
                        <input type="date" name="tgl_tender" id="tgl_tender" class="form-control" placeholder="Masukan No Memo">
                    </div>
                    <div class="custom-file mb-1">
                        <label class="custom-file-label" for="filetender">Pilih file</label>
                        <input type="file" name="filetender" id="filetender">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addtender" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Surat-->
<div class="modal fade" id="modelUbahTender">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Tender/ubahtender'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="text" name="id" id="id" hidden>
                        <label for="nama_proyek"></label>
                        <input type="text" name="nama_proyek" id="namaProyek" class="form-control" placeholder="Masukan Tanggal Surat Masuk" value="<?= $row['nama_proyek'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="tgl_tender"></label>
                        <input type="date" name="tgl_tender" id="tgl_tender" class="form-control" placeholder="Masukan tgl_tender" value="<?= $row['tgl_tender'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="filetender"></label>
                        <input type="text" name="filetender" id="filetender" class="form-control" placeholder="Masukan filetender" value="<?= $row['filetender'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahtender" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Data Surat Masuk-->
<div class="modal fade" id="modelHapusTender">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="Tender/hapustender/<?= $row['id_tender']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal download Data-->
<div class="modal fade" id="modelDownloadTender">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin mendownload file ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="text" id="id" value="<?= $row['id_tender']; ?>">
                <input type="text" id="filetender" value="<?= $row['filetender']; ?>">
                <a href="Tender/download/<?= $row['filetender'] ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<?= $this->endSection() ?>