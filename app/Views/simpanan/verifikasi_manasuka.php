<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3> Simpanan Manasuka</h3>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">

</div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">


                    <?php if (session()->getFlashdata('message') !== NULL) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('message'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <!-- <a href="/user/add" type="button" class="btn btn-primary btn-sm">Tambah</a> -->
                        <!-- <a href="/simpanan_manasuka" class="btn btn-primary" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Kembali</a> -->
                        <div class="table-responsive">
                           
                            <table class="display" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Nama Penerima</th>
                                        <th>Nama Bank</th>
                                        <th>No Rekening</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Tgl Penarikan</th>
                                        <th>Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($verifikasi_manasuka as $a) : ?>
                                        <tr>
                                            <th><?= $no++ ?></th>
                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->nama_penerima ?></td>
                                            <td><?= $a->nama_bank ?></td>
                                            <td><?= $a->no_rekening ?></td>
                                            <td><?php if ($a->jenis == "Masuk") { ?>
                                                    Rp. <?= number_format($a->nominal, 0, ",", ".")  ?>
                                                <?php  } else { ?>
                                                    Rp. <?= number_format($a->nominal_tarik, 0, ",", ".")  ?>
                                                <?php }  ?>
                                            </td>
                                            <td><?php if ($a->status == 1) { ?>
                                                    Berhasil
                                                <?php } elseif ($a->status == 2) { ?>
                                                    Pending
                                                <?php } else { ?>

                                                    Verifikasi Admin
                                                <?php } ?></td>
                                            <td><?= $a->tgl_penarikan ?></td>
                                            <td><a data-bs-toggle="modal" data-original-title="test" data-bs-target="#openimage<?= $a->id ?>" type="button" title="Transfer Uang" class="">

                                                    <img src="<?= base_url('assets/foto/bukti_transfer/' . $a->image . ''); ?>" alt="Upload Image" width="70" height="70">
                                                </a>
                                            </td>
                                            <?php if ($a->status == 2) { ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <!-- <button data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal<?= $a->id ?>" type="button" title="Edit Data" class="btn btn-danger">
                                                            <i class="fa fa-dollar"></i>
                                                        </button> -->
                                                        <a href="/simpanan/acc_manasuka/<?= $a->id ?>" type="button" title="Acc Penarikan" class="btn btn-warning"><i class="fa fa-check"></i> </a>
                                                    </div>
                                                </td>
                                            <?php } elseif ($a->status == 3) { ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal<?= $a->id ?>" type="button" title="Transfer Uang" class="btn btn-primary btn-*-gradien">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                        <!-- <a href="/simpanan/acc_manasuka/<?= $a->id ?>" type="button" title="Acc Penarikan" class="btn btn-warning"><i class="fa fa-check"></i> </a> -->
                                                    </div>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-bs-toggle="modal" data-original-title="done" type="button" title="Done" class="btn btn-success btn-*-gradien">
                                                            Done
                                                        </button>
                                                        <!-- <a href="/simpanan/acc_manasuka/<?= $a->id ?>" type="button" title="Acc Penarikan" class="btn btn-warning"><i class="fa fa-check"></i> </a> -->
                                                    </div>
                                                </td>
                                           <?php } ?>
                                        </tr>
                                        <div class="modal fade" id="exampleModal<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Transfer</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('simpanan/upload_image/' . $a->id . ''); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data" method="post">
                                                            <?= csrf_field() ?>
                                                            <div class="row g-3">
                                                                <input type="hidden" name="id" value="<?= $a->id ?>" hidden>

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
                                                                    <input class="form-control" readonly id="nominal" name="nominal" type="number" value="<?= $a->nominal_tarik ?>" required="">
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
                                        <div class="modal fade" id="openimage<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="openimagefix" aria-hidden="true">
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
                                    <?php endforeach ?>
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