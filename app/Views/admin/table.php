<?= $this->extend('layout/defaultAdmin') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="mt-5">Data Table</h1>
            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($table as $row) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['ordner']; ?></td>
                            <td><?= $row['keterangan']; ?></td>
                            <td><a href="">test</a></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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