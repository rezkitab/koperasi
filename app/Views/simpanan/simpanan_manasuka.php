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

                    <?php if (session()->getFlashdata('message') !== NULL) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('message'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#TambahManasuka" type="button" class="btn btn-primary btn-sm">Tambah</a>

                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Metode Membayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($simpanan_manasuka as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $a->full_name ?></td>
                                            <td>Rp. <?= number_format($a->nominal, 0, ",", ".")  ?></td>
                                            <td><?= $a->tgl_bayar ?></td>

                                            <td><?php if ($a->status == 2) { ?>
                                                    Pending
                                                <?php } else { ?>
                                                    Lunas
                                                <?php } ?></td>
                                            <td><?= $a->metode_pembayaran ?></td>

                                            <?php if ($a->status == 1) { ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal<?= $a->id ?>" type="button" title="Ambil Uang" class="btn btn-warning">
                                                            <i class="fa fa-dollar"></i>
                                            </a> 
                                                    </div>
                                                    <div class="btn-group">
                                                    <a href="/simpanan/detail_manasuka/<?= $a->id ?>" type="button" class="btn btn-primary">
                                                            <i class="fa fa-info-circle"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            <?php }  ?>
                                        </tr>

                                        <div class="modal fade" id="exampleModal<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tarik Simpanan</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('simpanan/add_riwayat_manasuka/' . $a->id . ''); ?>" class="needs-validation" novalidate="" method="post">
                                                            <?= csrf_field() ?>
                                                            <div class="row g-3">
                                                                <input type="text" name="id_manasuka" value="<?= $a->id ?>" hidden>
                                                                <div class="col-md-12">
                                                                    <label>Nama Lengkap</label>
                                                                    <input class="form-control" id="nama_pemilik" name="nama_pemilik" type="text" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Nama Bank</label>
                                                                    <input class="form-control" id="nama_bank" name="nama_bank" type="text" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>No Rekening</label>
                                                                    <input class="form-control" id="no_rekening" name="no_rekening" type="number" required="">
                                                                    <div class="valid-feedback">Looks good!</div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Nominal</label>
                                                                    <input class="form-control" id="nominal" name="nominal" type="number" required="">
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
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="TambahManasuka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Simpanan</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form id="payment-form" action="<?= base_url('simpanan/pay_manasuka'); ?>" class="needs-validation" novalidate="" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="result_type" id="result-type" value="">
                                                        <input type="hidden" name="result_data" id="result-data" value="">
                                                        <div class="row g-3">
                                                            <div class="col-md-12">
                                                                <label>Nominal</label>
                                                                <input class="form-control" id="nominal" onkeyup="getvalue(this.value)" type="text" required="">
                                                                <input hidden class="form-control" id="rp" name="nominal" type="text" required="">
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <button class="btn btn-primary" id="pay-button" style="margin-left: 75%;" type="submit">Simpan</button>
                                                    </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>