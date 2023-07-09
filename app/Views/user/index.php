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
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Nik</th>
                                        <th>No Telpon</th>
                                        <th>Active</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($users as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $a->username ?></td>
                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->nik ?></td>
                                            <td><?= $a->no_hp ?></td>
                                            <td><?php if ($a->is_active == 1) { ?>
                                                    Active
                                                <?php } else { ?>
                                                    No Active
                                                <?php } ?></td>
                                            <td><?= $a->created_at ?></td>
                                            <td><?= $a->updated_at ?></td>

                                            <td>
                                                <div class="btn-group">
                                                    <a href="/user/edit/<?= $a->id_user ?>" type="button" title="Edit Data" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter<?= $a->id_user ?>">
                                                        <i class=" fa fa-times"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="exampleModalCenter<?= $a->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Users</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Yakin ingin menghapus users dengan nama <?= $a->username ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('user/delete_proses/' . $a->id_user . '') ?>" class="btn btn-danger" type="button">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                    ?>
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