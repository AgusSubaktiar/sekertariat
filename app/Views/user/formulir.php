<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Tabel Data Formulir</h1>
    </div>

    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Formulir<strong><?= session()->getFlashdata('message'); ?></strong>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambahFormulir">
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
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama File</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tbody>
                                        <?php
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $no = 1 + (10 * ($page - 1));

                                        foreach ($formulir as $row) : ?>
                                            <tr>
                                                <td scope"row"><?= $no; ?></td>
                                                <td><?= $row['ordner']; ?></td>
                                                <td><?= $row['keterangan']; ?></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-target="#modelDownloadFormulir" class="btn btn-sm btn-success"> <i class="fas fa-download"></i></button>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <ul class="pagination mb-0">
                                        <li class="page-item active"><?= $pager->links('default', 'pagination'); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
</section>


<!-- Modal download Data Memo Keluar-->
<div class="modal fade" id="modelDownloadFormulir">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin mendownload file ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a href="FormulirUser/download/<?= $row['ordner'] ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>