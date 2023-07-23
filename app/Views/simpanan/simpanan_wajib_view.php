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
    <div class="container-fluid">

    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Nominal</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($simpanan_wajib as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->tgl_bayar ?></td>
                                            <td><?= $a->nama_bulan ?></td>


                                            <td><?php if ($a->status == 200) { ?>
                                                    Berhasil
                                                <?php } elseif ($a->status == 201) { ?>
                                                    Pending
                                                <?php } else { ?>
                                                    Gagal
                                                <?php } ?></td>
                                            <td>Rp. <?= number_format($a->nominal, 0, ",", ".")  ?></td>

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
</div>

<?= $this->endsection(); ?>