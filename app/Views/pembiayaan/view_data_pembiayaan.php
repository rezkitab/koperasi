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
                        <li class="breadcrumb-item active">Pembiayaan</li>
                    </ol>
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
                        <a href="<?= base_url('pembiayaan/add') ?>" class="btn btn-primary text-white"><i class="fa fa-plus"></i> Pembiayaan</a>
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Kode Pembiayaan</th>
                                        <th>Tgl Pembiayaan</th>
                                        <th>Jumlah Pembiayaan</th>
                                        <th>Margin</th>
                                        <th>Biaya Administrasi</th>
                                        <th>Total Pembiayaan</th>
                                        <th>Status</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pembiayaan as $data) : ?>
                                        <tr>
                                            <th class="text-center"><?= $no++ ?></th>
                                            <td><?= $data['kode_pembiayaan'] ?></td>
                                            <td><?= $data['tgl_pembiayaan'] ?></td>
                                            <td><?= nominal($data['jumlah_pembiayaan']) ?></td>
                                            <td><?= $data['margin'] ?> %</td>
                                            <td><?= nominal($data['biaya_administrasi']) ?></td>
                                            <td><?= nominal($data['total_pembiayaan']) ?></td>
                                            <td><?php if ($data['status'] == 'Belum Lunas') : ?>
                                                    <?php if ($data['status_pembiayaan'] == 'Ditolak') : ?>
                                                        <span class="badge bg-warning text-white">-</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-warning text-white"><?= $data['status'] ?></span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if ($data['status_pembiayaan'] == 'Ditolak') : ?>
                                                        <span class="badge bg-warning text-white">-</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-warning text-white"><?= $data['status'] ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($data['status_pembiayaan'] == 'Menunggu Persetujuan') : ?>
                                                    <span class="badge bg-warning text-white"><?= $data['status_pembiayaan'] ?></span>
                                                <?php elseif ($data['status_pembiayaan'] == 'Ditolak') : ?>
                                                    <span class="badge bg-danger text-white"><?= $data['status_pembiayaan'] ?></span>
                                                <?php else : ?>
                                                    <span class="badge bg-success text-white"><?= $data['status_pembiayaan'] ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($data['status_pembiayaan'] == 'Menunggu Persetujuan') : ?>
                                                    <a data-bs-toggle="modal" data-bs-target="#update<?= $data['id']; ?>" type="button" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <?php elseif ($data['status_pembiayaan'] == 'Ditolak') : ?>

                                                <?php else : ?>
                                                    <a href="<?= base_url('pembiayaan/detail/' . $data['id']) ?>" type="button" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"> Detail</i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
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

    <?php foreach ($pembiayaan as $data) : ?>
        <div id="update<?= $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary pt-2 pb-2">
                        <h5 class="modal-title mt-0 text-white">Konfirmasi Pengajuan ?</h5>
                    </div>
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    <div class="modal-body">
                        <div class="row invo-header pb-2">
                            <div class="col-sm-6 ">
                                <input type="hidden" value="<?= $data['id'] ?>" id="pembiayaan_id">
                                <table>
                                    <tr>
                                        <td>Nama Anggota</td>
                                        <td>:</td>
                                        <td><?= $data['full_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Pembiayaan</td>
                                        <td>:</td>
                                        <td><?= format_date($data['tgl_pembiayaan']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Akad</td>
                                        <td>:</td>
                                        <td><?= $data['jenis_pembiayaan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Pembiayaan</td>
                                        <td>:</td>
                                        <td><?= nominal($data['jumlah_pembiayaan']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Angsuran</td>
                                        <td>:</td>
                                        <td><?= $data['angsuran'] ?> x</td>
                                    </tr>
                                    <tr>
                                        <td>Margin</td>
                                        <td>:</td>
                                        <td><?= $data['margin'] ?> %</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Administrasi</td>
                                        <td>:</td>
                                        <td><?= nominal($data['biaya_administrasi']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Pembiayaan</td>
                                        <td>:</td>
                                        <td><?= nominal($data['total_pembiayaan']) ?></td>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $total_angsuran = 0;
                                        foreach ($data['detail'] as $list) :
                                            $total_angsuran += $list['jumlah_angsuran'] ?>
                                            <tr>
                                                <th class="text-center"><?= $no++ ?></th>
                                                <td><?= $list['angsuran_ke'] ?></td>
                                                <?php if ($list['angsuran_ke'] == 1) : ?>
                                                    <td><?= nominal($list['jumlah_angsuran'] + $data['biaya_administrasi']) ?></td>
                                                <?php else : ?>
                                                    <td><?= nominal($list['jumlah_angsuran']) ?></td>
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
                        <div class="modal-footer">
                            <a type="button" class="btn btn-info" data-bs-dismiss="modal"> Tutup</a>
                            <form action="<?= base_url('pembiayaan/tolak') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                            <form action="<?= base_url('pembiayaan/setujui') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                <button type="submit" class="btn btn-primary">Setujui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

</div>




<?= $this->endsection(); ?>