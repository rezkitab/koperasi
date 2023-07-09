<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3><?= $title ?></h3>
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
                        <a href="/user/add" type="button" class="btn btn-primary btn-sm">Tambah</a>

                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Owner</th>
                                        <th>Alamat</th>
                                        <th>Telpon</th>
                                        <th>Title</th>
                                        <th>Nama Aplikasi</th>
                                        <th>Logo</th>
                                        <th>Copy Right</th>
                                        <th>Versi</th>
                                        <th>Tahun</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    foreach ($aplikasi as $a) { ?>

                                        <tr>
                                            <td><?= $a['id'] ?></td>
                                            <td><?= $a['nama_owner'] ?></td>
                                            <td><?= $a['alamat'] ?></td>
                                            <td><?= $a['tlp'] ?></td>
                                            <td><?= $a['title'] ?></td>
                                            <td><?= $a['nama_aplikasi'] ?></td>
                                            <td><?= $a['logo'] ?></td>
                                            <td><?= $a['copy_right'] ?></td>
                                            <td><?= $a['versi'] ?></td>
                                            <td><?= $a['tahun'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="/setting/edit_aplikasi/<?= $a['id'] ?>" type="button" title="Edit Data" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter<?= $a['id'] ?>">
                                                        <i class=" fa fa-times"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="edit-apk<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Edit</span>
                                                            <span class="fw-light">
                                                                Aplikasi
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="<?php echo base_url() . 'setting/update/' . $a['id'] . ''; ?>" method="post" enctype="multipart/form-data">
                                                            <input id="id" name="id" value="<?= $a['id'] ?>" type="text" class="form-control" placeholder="fill name" hidden>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Owner</label>
                                                                        <input id="nama_owner" name="nama_owner" value="<?= $a['nama_owner'] ?>" type="text" class="form-control" placeholder="fill name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Alamat</label>
                                                                        <input id="alamat" name="alamat" value="<?= $a['alamat'] ?>" type="text" class="form-control" placeholder="fill position">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Telpon</label>
                                                                        <input id="tlp" name="tlp" value="<?= $a['tlp'] ?>" type="text" class="form-control" placeholder="fill office">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Title</label>
                                                                        <input id="title" name="title" value="<?= $a['title'] ?>" type="text" class="form-control" placeholder="fill name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Aplikasi</label>
                                                                        <input id="nama_aplikasi" name="nama_aplikasi" value="<?= $a['nama_aplikasi'] ?>" type="text" class="form-control" placeholder="fill position">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Logo</label>
                                                                        <input type="file" class="form-control" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Copy Right</label>
                                                                        <input id="copy_right" name="copy_right" value="<?= $a['copy_right'] ?>" type="text" class="form-control" placeholder="fill name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Versi</label>
                                                                        <input id="versi" name="versi" value="<?= $a['versi'] ?>" type="text" class="form-control" placeholder="fill position">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Tahun</label>
                                                                        <input id="tahun" name="tahun" value="<?= $a['tahun'] ?>" type="text" class="form-control" placeholder="fill office">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="modal-footer no-bd">
                                                                <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>