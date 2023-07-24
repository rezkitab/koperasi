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
                        <?php if ($simpanan_wajib != null) : ?>
                            <a href="<?= base_url('pembiayaan/anggota_add') ?>" class="btn btn-primary text-white"><i class="fa fa-plus"></i> Pengajuan</a>
                        <?php else : ?>
                          <!-- <h5 >*Silahkan membayar simpanan pokok dan simpanan wajib untuk mengajukan pembiayaan.</h5> -->
                           <h7 style="color: #fd2e64; font-weight: bold;">*Silahkan membayar simpanan pokok dan simpanan wajib untuk mengajukan pembiayaan.</h7>
                        <?php endif ?>
                        
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

                                                <?php elseif ($data['status_pembiayaan'] == 'Ditolak') : ?>

                                                <?php else : ?>
                                                    <a href="<?= base_url('pembiayaan/anggota/detail/' . $data['id']) ?>" type="button" class="btn btn-info btn-sm">
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
</div>

<?= $this->endsection(); ?>