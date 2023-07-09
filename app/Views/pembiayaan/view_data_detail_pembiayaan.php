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
                                    </table>
                                    <!-- End Info-->
                                </div>
                            </div>

                            <div>
                                <div class="table-responsive invoice-table" id="table">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Angsuran ke</th>
                                                <th>Jumlah Angsuran</th>
                                                <th>Tgl Pembayaran</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
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
                                                    <td><?= $data['tgl_pembayaran'] ? format_date($data['tgl_pembayaran']) : '' ?></td>
                                                    <td><?php if ($data['status'] == 'Belum Dibayar') : ?>
                                                            <span class="badge bg-warning text-white"><?= $data['status'] ?></span>
                                                        <?php else : ?>
                                                            <span class="badge bg-success text-white"><?= $data['status'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($data['status'] == 'Belum Dibayar') : ?>
                                                            <a data-bs-toggle="modal" data-bs-target="#update<?= $data['id']; ?>" type="button" class="btn btn-success btn-sm">
                                                                <i class="fa fa-money"> Bayar</i>
                                                            </a>
                                                        <?php else : ?>
                                                            <!-- <a href="<?= base_url('pembiayaan/print-angsuran/' . $data['id']) ?>" type="button" class="btn btn-secondary btn-sm">
                                                                <i class="fa fa-print"> Cetak</i>
                                                            </a> -->
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end">Total:</td>
                                                <td><?= nominal($total_angsuran) ?></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- End InvoiceBot-->
                        </div>
                        <div class="col-sm-12 text-center mt-3">
                            <!-- <button class="btn btn btn-primary me-2" type="button" onclick="myFunction()" data-bs-original-title="" title="">Print</button> -->
                            <a href="<?= base_url('pembiayaan') ?>" class="btn btn-secondary btn-sm" type="button">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($detail_pembiayaan as $data) : ?>
        <form action="<?= base_url('pembiayaan/update') ?>" method="post">
            <div id="update<?= $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary pt-2 pb-2">
                            <h5 class="modal-title mt-0 text-white">Pembayaran Angsuran</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $pembiayaan['id']; ?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-control-label">Tgl Pembayaran</label>
                                        <div class="input-group input-group-merge">
                                            <div class="col-sm-12">
                                                <input class="form-control form-control-sm" type="text" readonly value="<?= format_date(date('Y-m-d')) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-control-label">Jumlah Yang Harus Dibayar</label>
                                        <div class="input-group input-group-merge">
                                            <div class="col-sm-12">
                                                <?php if ($detail_pembiayaan[0]['status'] == 'Belum Dibayar') : ?>
                                                    <input type="hidden" name="angsuran_ke" value="1">
                                                    <input class="form-control form-control-sm" type="text" readonly value="<?= nominal($data['jumlah_angsuran'] + $pembiayaan['biaya_administrasi']) ?>">
                                                <?php else : ?>
                                                    <input type="hidden" name="angsuran_ke" value="<?= $data['angsuran_ke'] ?>">
                                                    <input class="form-control form-control-sm" type="text" readonly value="<?= nominal($data['jumlah_angsuran']) ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach ?>
</div>

<?= $this->endsection(); ?>