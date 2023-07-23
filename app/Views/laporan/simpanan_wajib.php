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
                        <form action="<?= base_url('LaporanController/search_wajib'); ?>" method="post">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select class="bootstrap-select strings selectpicker form-control" name="id_user" id="id_user" required="">
                                            <option value="">Pilih Anggota</option>
                                            <?php foreach ($users as $us) { ?>

                                                <option value="<?= $us->id_user ?>"> <?php echo $us->full_name; ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="bootstrap-select strings selectpicker form-control" name="status" id="status" required="">
                                            <option value="">Pilih Status</option>
                                            <option value="">Semua Status</option>
                                            <option value="200">Berhasil</option>
                                            <option value="201">Pending</option>
                                            <option value="202">Gagal</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="form-control btn btn-primary" style="color: white;">Cari</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="/LaporanController/simpanan_wajib" class="form-control btn btn-warning" style="color: white;">Reset</a>
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
                                                <b>LAPORAN SIMPANAN WAJIB</b>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <b>Periode</b>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <?php if ($id_user != "") { ?>
                                                <a target="_blank" href="/LaporanController/pdf_wajib/<?= $id_user ?>/<?= $tgl_bayar ?>/<?= $status ?>" class="form-control btn btn-danger" style="color: white; width: 10%">PDF</a>
                                            <?php } else { ?>
                                                <a target="_blank" href="/LaporanController/pdf_wajib_all" class="form-control btn btn-danger" style="color: white; width: 10%">PDF</a>

                                            <?php }  ?>
                                            <br>
                                            <br>
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