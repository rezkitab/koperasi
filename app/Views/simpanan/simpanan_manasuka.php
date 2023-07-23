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
                        <a href="/simpanan/add_manasuka" type="button" class="btn btn-primary btn-sm">Tambah</a>
                        <button data-bs-toggle="modal" data-original-title="test" data-bs-target="#AmbilUang" type="button" title="Ambil Uang" class="btn btn-warning">
                            <i class="fa fa-dollar"> Tarik</i>
                        </button>
                        <button type="button" class="btn btn-success" id="saldo">
                            <?php if (!empty($saldo)) { ?>
                                Saldo: Rp. <?= number_format($saldo[0]->total, 0, ",", ".")  ?>
                           <?php } else { ?>
                            Saldo: Rp. 0
                          <?php } ?>
                            
                        </button>

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
                                        <th>Jenis</th>
                                        <th>Metode Membayaran</th>
                                        <th>Panduan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($simpanan_manasuka as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $a->full_name ?></td>
                                            <td><?php if ($a->jenis == "Masuk") { ?>
                                                    Rp. <?= number_format($a->nominal, 0, ",", ".")  ?>
                                                <?php  } else { ?>
                                                    Rp. <?= number_format($a->nominal_tarik, 0, ",", ".")  ?>
                                                <?php }  ?>
                                            </td>


                                            <td><?php if ($a->jenis == "Masuk") { ?>
                                                    <?= $a->tgl_bayar ?>
                                                <?php  } else { ?>
                                                    <?= $a->tgl_penarikan ?>
                                                <?php }  ?>
                                            </td>

                                            <td><?php if ($a->status == 2) { ?>
                                                    <button class="btn btn-info">Pending</button>
                                                <?php } else { ?>
                                                    <button class="btn btn-warning">Lunas</button>
                                                <?php } ?>
                                            </td>
                                            <td><?= $a->jenis ?></td>
                                            <td><?= $a->metode_pembayaran ?></td>

                                            <td><?php if ($a->jenis == "Masuk") { ?>
                                                    <a target="_blank" rel="noopener noreferrer" href="<?= $a->pdf_url ?>">Open Pdf
                                                    <?php  } else { ?>
                                                        <a data-bs-toggle="modal" data-original-title="test" data-bs-target="#openimage<?= $a->id ?>" type="button" title="Transfer Uang" class="">

                                                            <img src="<?= base_url('assets/foto/bukti_transfer/' . $a->image . ''); ?>" alt="Upload Image" width="70" height="70">
                                                        </a>
                                                    <?php }  ?>
                                            </td>


                                        </tr>

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
<div class="modal fade" id="AmbilUang" tabindex="-1" role="dialog" aria-labelledby="AmbilUangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AmbilUangLabel">Tarik Simpanan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('simpanan/add_riwayat_manasuka'); ?>" class="needs-validation" novalidate="" method="post">
                    <?= csrf_field() ?>
                    <div class="row g-3">
         
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
                            <input class="form-control" id="nominal_tarik" name="nominal_tarik" type="number" required="">
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
<?= $this->endsection(); ?>