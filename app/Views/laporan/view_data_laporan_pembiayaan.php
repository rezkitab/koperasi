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
                        <form action="<?= base_url('laporan-pembiayaan/filter') ?>" method="POST" class="no-validated row g-3">
                            <div class="form-group col-md-2 mb-1">
                                <select class="form-control" required name="month">
                                    <option value="" disabled selected>Bulan</option>
                                    <?php for ($i = 1; $i < 13; $i++) { ?>
                                        <option value="<?= $i ?>"><?= format_bulan($i) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2 mb-1">
                                <select class="form-control" required name="year">
                                    <option value="" disabled selected>Tahun</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1 mb-1">
                                <button type="submit" class="btn btn-primary"> Cari</button>
                            </div>
                            <?php if ($lap_pembiayaan != null) { ?>
                                <div class="form-group col-md-2 mb-1">
                                    <a target="_blank" class="btn btn-danger" href="<?= base_url('laporan-pembiayaan/pdf') ?>"><i class="fa fa-file"> Export </i> </a>
                                </div>
                            <?php } ?>
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
                        <div class="pb-2">
                            <div class="row">
                                <div class="col-sm-12" style="background-color:white;" align="center">
                                    <b>KOPERASI SYARIAH</b>
                                </div>
                                <div class="col-sm-12" style="background-color:white;" align="center">
                                    <b>LAPORAN PEMBIAYAAN</b>
                                </div>
                                <div class="col-sm-12" style="background-color:white;" align="center">
                                    <b>Periode <?= $month ?> <?= $year ?></b>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Anggota</th>
                                        <th>Jumlah Pembiayaan</th>
                                        <th>Total Pembiayaan</th>
                                        <th>Angsuran ke</th>
                                        <th>Jumlah Angsuran</th>
                                        <th>Sisa Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $saldo_pembiayaan = 0;
                                    foreach ($lap_pembiayaan as $data) :
                                        $saldo_pembiayaan =  $data['total_pembiayaan'] -  ($data['angsuran_ke'] * $data['jumlah_angsuran']) ?>
                                        <tr>
                                            <th><?= $no++ ?></th>
                                            <td><?= $data['full_name'] ?></td>
                                            <td><?= nominal($data['jumlah_pembiayaan']) ?></td>
                                            <td><?= nominal($data['total_pembiayaan']) ?> </td>
                                            <td><?= $data['angsuran_ke'] ?> </td>
                                            <td><?= nominal($data['jumlah_angsuran']) ?></td>
                                            <td><?= nominal($saldo_pembiayaan) ?></td>
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