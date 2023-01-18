<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Surat Keluar</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Surat Keluar<strong><?= session()->getFlashdata('message'); ?></strong>
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
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="myTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Surat</th>
                                            <th>No Surat</th>
                                            <th>Kepada</th>
                                            <th>Perihal</th>
                                            <th>Kode Proyek</th>
                                            <th>Nama Proyek</th>
                                            <th>ordner</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        // $no = 1 + (10 * ($page - 1));
                                        $no = 1;
                                        foreach ($suratkeluar as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['tgl_suratkeluar']; ?></td>
                                                <td><?= $row['no_suratkeluar']; ?></td>
                                                <td><?= $row['kepada']; ?></td>
                                                <td><?= $row['perihal']; ?></td>
                                                <td><?= $row['kode_proyek']; ?></td>
                                                <td><?= $row['nama_proyek']; ?></td>
                                                <td><?= $row['ordner']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelUbahSuratKeluar" id="btn-editsuratkeluar" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-tgl_suratkeluar="<?= $row['tgl_suratkeluar']; ?>" data-no_suratkeluar="<?= $row['no_suratkeluar']; ?>" data-kepada="<?= $row['kepada']; ?>" data-perihal="<?= $row['perihal']; ?>" data-kode_proyek="<?= $row['kode_proyek']; ?>" data-nama_proyek="<?= $row['nama_proyek']; ?>" data-ordner="<?= $row['ordner']; ?>"> <i class="fas fa-edit"></i></button>
                                                    <button type="button" data-toggle="modal" data-target="#modelHapusSuratKeluar" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></button>

                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
</section>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="modelTambahSuratMasuk">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratKeluar/addsuratkeluar'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <label for="tgl_suratkeluar"></label>
                        <input type="date" name="tgl_suratkeluar" id="tgl_suratkeluar" class="form-control" placeholder="Masukan Tanggal Surat Keluar">
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_suratkeluar"></label>
                        <input type="text" name="no_suratkeluar" id="no_suratkeluar" class="form-control" placeholder="Masukan No surat keluar">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan Kepada">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kode_proyek"></label>
                        <input type="text" name="kode_proyek" id="kode_proyek" class="form-control" placeholder="Masukan kode proyek">
                    </div>
                    <div class="form-group mb-1">
                        <label for="nama_proyek"></label>
                        <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" placeholder="Masukan nama proyek">
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="ordner">Pilih file</label>
                        <input type="file" name="ordner" id="ordner">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addsuratkeluar" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Surat Keluar-->
<div class="modal fade" id="modelUbahSuratKeluar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('SuratKeluar/ubahsuratkeluar'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-1">
                        <input type="hidden" name="id" id="id-suratkeluar">
                        <label for="tgl_suratkeluar"></label>
                        <input type="date" name="tgl_suratkeluar" id="tgl_suratkeluar" class="form-control" placeholder="Masukan Tanggal Surat Keluar" <?= $row['tgl_suratkeluar'] ?>>
                    </div>
                    <div class="form-group mb-1">
                        <label for="no_suratkeluar"></label>
                        <input type="text" name="no_suratkeluar" id="no_suratkeluar" class="form-control" placeholder="Masukan No surat masuk" value="<?= $row['no_suratkeluar'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kepada"></label>
                        <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukan kepada" value="<?= $row['kepada'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="perihal"></label>
                        <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukan perihal" value="<?= $row['perihal'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="kode_proyek"></label>
                        <input type="text" name="kode_proyek" id="kode_proyek" class="form-control" placeholder="Masukan kode proyek" value="<?= $row['kode_proyek'] ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="nama_proyek"></label>
                        <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" placeholder="Masukan nama proyek" value="<?= $row['nama_proyek'] ?>">
                    </div>
                    <div class=" form-group mb-1">
                        <label for="ordner"></label>
                        <input type="text" name="ordner" id="ordner" class="form-control" placeholder="Masukan ordner" value="<?= $row['ordner'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubahsuratkeluar" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus Data Surat Keluar-->
<div class="modal fade" id="modelHapusSuratKeluar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus anda ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="SuratKeluar/hapussuratkeluar/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
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