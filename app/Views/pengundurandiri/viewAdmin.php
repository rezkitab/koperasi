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
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Nik</th>
                                        <th>Nama Rekening</th>
                                        <th>No Rekening</th>
                                        <th>Nominal</th>
                                        <th>Created</th>
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
                                            <td><?= $a->nama_penerima ?></td>
                                            <td><?= $a->no_rekening ?></td>
                                            <td>Rp. <?= number_format($a->nominal) ?></td>
                                            <td><?= $a->updated_at ?></td>

                                            <td>

                                                <div class="btn-group">
                                                    <?php if ($a->is_active == 3) { ?>
                                                        <button data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal<?= $a->id_user ?>" type="button" title="Transfer Uang" class="btn btn-primary btn-*-gradien">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                    <?php } else { ?>
                                                        <a data-bs-toggle="modal" data-original-title="test" data-bs-target="#openimage<?= $a->id_user ?>" type="button" title="Transfer Uang" class="">
                                                            <img src="<?= base_url('assets/foto/bukti_transfer/' . $a->image . ''); ?>" alt="Upload Image" width="70" height="70">
                                                        </a>
                                                    <?php } ?>


                                                </div>


                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal<?= $a->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('PengunduranDiri/upload_image/' . $a->id_user . ''); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data" method="post">
                                                            <?= csrf_field() ?>
                                                            <div class="row g-3">
                                                                <input type="hidden" name="id" value="<?= $a->id_user ?>" hidden>
                                                                <div class="col-md-12">
                                                                    <label>Nama Lengkap</label>
                                                                    <input readonly class="form-control" id="nama_pemilik" name="nama_pemilik" type="text" value="<?= $a->nama_penerima ?>" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Nama Bank</label>
                                                                    <input readonly class="form-control" id="nama_bank" name="nama_bank" type="text" value="<?= $a->nama_bank ?>" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>No Rekening</label>
                                                                    <input readonly class="form-control" id="no_rekening" name="no_rekening" type="number" value="<?= $a->no_rekening ?>" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Nominal</label>
                                                                    <input class="form-control" readonly id="nominal" name="nominal" type="number" value="<?= $a->nominal ?>" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Bukti Transfer</label>
                                                                    <input class="form-control" id="image" name="image" type="file" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                                    <button class="btn btn-secondary" type="submit">Save changes</button>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="openimage<?= $a->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="openimagefix" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="openimagefix">Bukti Transfer</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?= base_url('assets/foto/bukti_transfer/' . $a->image . ''); ?>" alt="Upload Image" width="500" height="400" style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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