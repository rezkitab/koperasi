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
                        <li class="breadcrumb-item"><a href="<?= base_url('pengurus') ?>">Pengurus</a></li>
                        <li class="breadcrumb-item active">Tambah Data Pengurus</li>
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
                    <div class="card-body pt-0">
                        <form action="<?= base_url('pengurus/create') ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Nama Pengurus</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" name="nama_pengurus" value="<?= old('nama_pengurus'); ?>" placeholder="Nama Pengurus" autocomplete="off">
                                                <?php if (validation_show_error('nama_pengurus')) : ?>
                                                    <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('nama_pengurus'); ?>
                                                        </span></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Fakultas</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" name="fakultas" value="<?= old('fakultas'); ?>" placeholder="Fakultas" autocomplete="off">
                                                <?php if (validation_show_error('fakultas')) : ?>
                                                    <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('fakultas') ?></span></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Jabatan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" name="jabatan" value="<?= old('jabatan'); ?>" placeholder="Jabatan" autocomplete="off">
                                                <?php if (validation_show_error('jabatan')) : ?>
                                                    <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('jabatan') ?></span></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">No Hp</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control form-control-sm" name="no_hp" value="<?= old('no_hp'); ?>" placeholder="No Hp" autocomplete="off">
                                                <?php if (validation_show_error('no_hp')) : ?>
                                                    <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('no_hp') ?></span></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" name="email" value="<?= old('email'); ?>" placeholder="Email" autocomplete="off">
                                                <?php if (validation_show_error('email')) : ?>
                                                    <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('email') ?></span></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control form-control-sm" name="alamat" value="<?= old('email'); ?>" cols="30" rows="5"></textarea>
                                                <?php if (validation_show_error('alamat')) : ?>
                                                    <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('alamat') ?></span></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Foto</label>
                                            <div class="col-sm-9">
                                                <div class="upload-button">
                                                    <input class="form-control" accept="image/png, image/jpg, image/jpeg" type="file" name="pengurus_image" />
                                                </div>
                                                <div class="upload-button pt-2 pl-2 pb-2">
                                                    <span class="badge bg-info text-white">kosongkan jika tidak memiliki gambar</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="<?= base_url('pengurus') ?>" class="btn btn-light btn-sm">Kembali</a>
                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>