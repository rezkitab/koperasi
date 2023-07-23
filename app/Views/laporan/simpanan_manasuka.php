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
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('LaporanController/search_manasuka'); ?>" method="post">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="bootstrap-select strings selectpicker form-control" name="id_user" id="id_user" required="">
                                            <option value="">Pilih Anggota</option>
                                            <?php foreach ($users as $us) { ?>

                                                <option value="<?= $us->id_user ?>"> <?php echo $us->full_name; ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="form-control btn btn-primary" style="color: white;">Cari</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="/LaporanController/simpanan_manasuka" class="form-control btn btn-warning" style="color: white;">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                    <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <div class="pb-2">
                            <div class="row">
                                <div class="col-sm-12" style="background-color:white;" align="center">
                                    <b>KOPERASI SYARIAH</b>
                                </div>
                                <div class="col-sm-12" style="background-color:white;" align="center">
                                    <b>LAPORAN SIMPANAN MANASUKA</b>
                                </div>
                                <div class="col-sm-12" style="background-color:white;" align="center">
                                    <b>Periode</b>
                                </div>
                            </div>
                        <div class="table-responsive">
                            <?php if ($id_user != "") { ?>
                                <a target="_blank" href="/LaporanController/pdf_manasuka/<?= $id_user ?>/<?= $tgl_bayar ?>" class="form-control btn btn-danger" style="color: white; width: 10%">PDF</a>
                            <?php } else { ?>
                                <a target="_blank" href="/LaporanController/pdf_manasuka_all" class="form-control btn btn-danger" style="color: white; width: 10%">PDF</a>

                            <?php }  ?>
                            <br>
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Bank</th>
                                        <th>No Rekening</th>
                                        <th>Jenis</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Tanggal Penarikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($simpanan_manasuka as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->nama_bank ?></td>
                                            <td><?= $a->no_rekening ?></td>
                                            <td><?= $a->jenis ?></td>
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

                                                    Gagal
                                                <?php } ?></td>
                                            <td><?= $a->tgl_penarikan ?></td>


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