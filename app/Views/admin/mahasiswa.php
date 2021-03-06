<?php
echo $this->extend('/layout/template');
echo $this->section('content');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <div class="card border-left-primary">
        <div class="card-body">
            <a data-toggle="modal" data-target="#modalAddMahasiswa" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= "Tabel Data " . $judul; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="toDataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-2">NIM</th>
                                    <th class="col-2">Nama</th>
                                    <th class="col-1">Jurusan</th>
                                    <th class="col-1">Fakultas</th>
                                    <th class="col-1">Jenis Kelamin</th>
                                    <th class="col-1">Angkatan</th>
                                    <th class="col-2">Dosen PA</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jurusan</th>
                                    <th>Fakultas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Angkatan</th>
                                    <th>Dosen PA</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($mahasiswa_list as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $row['nim']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['jurusan']; ?></td>
                                        <td><?= $row['fakultas']; ?></td>
                                        <td><?= $row['jenis_kelamin']; ?></td>
                                        <td><?= $row['angkatan']; ?></td>
                                        <td><?= $row['nama_dosen_pa']; ?></td>
                                        <td class="text-center">
                                            <form action="/Admin/Mahasiswa/<?= $row['nim']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="nim_param" value="<?= $row['nim']; ?>">
                                                <button type="submit" class="btn btn-success btn-sm" title="Edit"><i class="fas fa-edit "></i></button>
                                            </form>
                                            <form action="/Admin/Mahasiswa/<?= $row['nim']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Apakah anda yakin ingin menghapus mahasiswa <?= $row['nim']; ?> ?')"><i class="fas fa-trash "></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End of Data Table -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add Kategori -->
<?= view('modal/addMahasiswa') ?>

<?= $this->endSection(); ?>