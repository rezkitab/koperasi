<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3><?= $title ?></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pengurus</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= base_url('/pengurus/add') ?>" class="btn btn-primary text-white"><i class="fa fa-plus"></i> Pengurus</a>
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Foto</th>
                                        <th>Nama Pengurus</th>
                                        <th>Fakultas</th>
                                        <th>Jabatan</th>
                                        <th>No Hp</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengurus as $data) : ?>
                                        <tr>
                                            <th class="text-center"><?= $no++ ?></th>
                                            <td class="text-center"><img src="<?= base_url('upload/pengurus/' . $data['image']) ?>" width="72" alt="Foto"></td>
                                            <td><?= $data['nama_pengurus'] ?></td>
                                            <td><?= $data['fakultas'] ?></td>
                                            <td><?= $data['jabatan'] ?></td>
                                            <td><?= $data['no_hp'] ?></td>
                                            <td><?= $data['email'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td>
                                                <a type="button" href="<?= base_url('pengurus/edit/' . $data['id']) ?>" class="btn btn-primary btn-sm">
                                                    <i class=" fa fa-edit"></i>
                                                </a>
                                                <a data-bs-toggle="modal" data-bs-target="#delete<?= $data['id']; ?>" type="button" class="btn btn-danger btn-sm">
                                                    <i class=" fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php foreach ($pengurus as $data) : ?>
        <form action="<?= base_url('pengurus/delete') ?>" method="post">
            <div id="delete<?= $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary pt-2 pb-2">
                            <h5 class="modal-title mt-0 text-white">Apa Kamu Yakin ?</h5>
                        </div>
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</a>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach ?>
</div>

<?= $this->endsection(); ?>