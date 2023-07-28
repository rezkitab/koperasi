<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3><?= $title ?></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pembiayaan') ?>">Pembiayaan</a></li>
                        <li class="breadcrumb-item active">Data Detail Pembiayaan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row invo-header pb-2">

                                <input type="hidden" id="jumlah_pembiayaan" value="<?= $pembiayaan['jumlah_pembiayaan'] ?>">
                                <div class="col-sm-6 ">
                                    <table>
                                        <tr>
                                            <td>Nama Anggota</td>
                                            <td>:</td>
                                            <td><?= $pembiayaan['full_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Pembiayaan</td>
                                            <td>:</td>
                                            <td><?= format_date($pembiayaan['tgl_pembiayaan']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Akad</td>
                                            <td>:</td>
                                            <td><?= $pembiayaan['jenis_pembiayaan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Pembiayaan</td>
                                            <td>:</td>
                                            <td><?= nominal($pembiayaan['jumlah_pembiayaan']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Angsuran</td>
                                            <td>:</td>
                                            <td><?= $pembiayaan['angsuran'] ?> x</td>
                                        </tr>
                                        <tr>
                                            <td>Margin</td>
                                            <td>:</td>
                                            <td><?= $pembiayaan['margin'] ?> %</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Administrasi</td>
                                            <td>:</td>
                                            <td><?= nominal($pembiayaan['biaya_administrasi']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Pembiayaan</td>
                                            <td>:</td>
                                            <td><?= nominal($pembiayaan['total_pembiayaan']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Pembiayaan</td>
                                            <td>:</td>
                                            <td><?= $pembiayaan['status_pembiayaan'] ?></td>
                                        </tr>
                                    </table>
                                    <!-- End Info-->
                                </div>
                            </div>
                            <div class="pt-2 mb-2">
                                <form action="<?= base_url('pembiayaan/update_pengajuan') ?>" method="POST" class="no-validated row g-3">
                                    <input type="hidden" name="pembiayaan_id" value="<?= $pembiayaan['id'] ?>">
                                    <div class="form-group col-md-2 mb-1">
                                        <label class="col-form-label pt-0">Biaya Administrasi</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control biaya_administrasi" id="biaya_administrasi" placeholder="Biaya Admin" name="biaya_administrasi" value=" <?= $pembiayaan['biaya_administrasi'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mb-1">
                                        <label class="col-form-label pt-0">Margin</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm" type="number" value="10" value="<?= $pembiayaan['margin'] ?>" name="margin" min="1" max="100" required oninput="validity.valid||(value='');" id="margin">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mb-1">
                                        <label class="col-form-label pt-0">Angsuran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Angsuran" name="angsuran" value="<?= $pembiayaan['angsuran'] ?>" id="angsuran" required>
                                            <span class="input-group-text">x</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mb-1">
                                        <label class="col-form-label pt-0">Jumlah Angsuran</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input class="form-control form-control-sm" type="text" name="total_angsuran" readonly id="total_angsuran" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mb-1">
                                        <label class="col-form-label pt-0">Total Pembiayaan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input class="form-control form-control-sm" type="text" name="total_pembiayaan" readonly id="total_pembiayaan" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2 mb-1 pt-4">
                                        <button type="submit" class="btn btn-primary" id="proses" disabled> Update</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <div class="table-responsive invoice-table" id="table">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Angsuran ke</th>
                                                <th>Jumlah Angsuran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $total_angsuran = 0;
                                            foreach ($detail_pembiayaan as $data) :
                                                $total_angsuran += $data['jumlah_angsuran'] ?>
                                                <tr>
                                                    <th class="text-center"><?= $no++ ?></th>
                                                    <td><?= $data['angsuran_ke'] ?></td>
                                                    <?php if ($data['angsuran_ke'] == 1) : ?>
                                                        <td><?= nominal($data['jumlah_angsuran'] + $pembiayaan['biaya_administrasi']) ?></td>
                                                    <?php else : ?>
                                                        <td><?= nominal($data['jumlah_angsuran']) ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end">Total:</td>
                                                <td><?= nominal($total_angsuran) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- End InvoiceBot-->
                        </div>
                        <div class="col-sm-12 text-center mt-3 row-gl">
                            <a href="<?= base_url('pembiayaan') ?>" class="btn btn-secondary btn-sm" type="button">Kembali</a>
                            <?php if ($pembiayaan['status_pembiayaan'] != 'Menunggu Persetujuan Anggota') : ?>
                                <form action="<?= base_url('pembiayaan/tolak') ?>" method="post" class="form-inline">
                                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                </form>
                                <form action="<?= base_url('pembiayaan/setujui') ?>" method="post" class="form-inline">
                                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-primary">Setujui</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?= $this->endsection(); ?>



<?= $this->section('content-script'); ?>
<script>
    new AutoNumeric('.biaya_administrasi', autoNumericOptions);


    $(document).ready(function() {

        $('#anggota').change(function() {
            var anggota = $('#anggota').val();
            if (anggota != '') {
                $.ajax({
                    url: "<?= base_url('pembiayaan/fetch_anggota'); ?>",
                    method: "POST",
                    data: {
                        user_id: anggota,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#maks_pembiayaan').val(data.nominal);
                        console.log(data.nominal)
                    }
                });
            } else {
                $('#maks_pembiayaan').val(0);
            }
        });

        $('#angsuran').on('keyup', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = $('#biaya_administrasi').val().replaceAll(".", "");
            var margin = $('#margin').val() / 100;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + +biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
            total = $('#total_pembiayaan').val();
            if (total != '') {
                $('#proses').removeAttr('disabled');
            } else {
                $('#proses').attr('disabled', true);
            }

        });

        $('#angsuran').on('input', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = $('#biaya_administrasi').val().replaceAll(".", "");
            var margin = $('#margin').val() / 100;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + +biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
            total = $('#total_pembiayaan').val();
            if (total != '') {
                $('#proses').removeAttr('disabled');
            } else {
                $('#proses').attr('disabled', true);
            }

        });

        $('#margin').on('keyup', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = $('#biaya_administrasi').val().replaceAll(".", "");
            var margin = $('#margin').val() / 100;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + +biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
            total = $('#total_pembiayaan').val();
            if (total != '') {
                $('#proses').removeAttr('disabled');
            } else {
                $('#proses').attr('disabled', true);
            }

        });

        $('#margin').on('input', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = $('#biaya_administrasi').val().replaceAll(".", "");
            var margin = $('#margin').val() / 100;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + +biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
            total = $('#total_pembiayaan').val();
            if (total != '') {
                $('#proses').removeAttr('disabled');
            } else {
                $('#proses').attr('disabled', true);
            }

        });

        $('#biaya_administrasi').on('keyup', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = $('#biaya_administrasi').val().replaceAll(".", "");
            var margin = $('#margin').val() / 100;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + +biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
            total = $('#total_pembiayaan').val();
            if (total != '') {
                $('#proses').removeAttr('disabled');
            } else {
                $('#proses').attr('disabled', true);
            }

        });

        $('#biaya_administrasi').on('input', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = $('#biaya_administrasi').val().replaceAll(".", "");
            var margin = $('#margin').val() / 100;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + +biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
            total = $('#total_pembiayaan').val();
            if (total != '') {
                $('#proses').removeAttr('disabled');
            } else {
                $('#proses').attr('disabled', true);
            }

        });

    });
</script>

<?= $this->endSection('content-script'); ?>