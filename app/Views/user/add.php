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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <a href="/user" class="btn btn-primary" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="/user/add_proses" class="needs-validation" novalidate="" method="post">
                            <?= csrf_field() ?>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">Username</label>
                                    <input class="form-control" id="username" name="username" type="text" required>
                                    <?php if (validation_show_error('username')) : ?>
                                        <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('username'); ?>
                                            </span></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom02">Nama Lengkap</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text" required>
                                    <?php if (validation_show_error('full_name')) : ?>
                                        <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('full_name'); ?>
                                            </span></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" for="validationCustomUsername">Password</label>
                                    <div class="input-group">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="*******" aria-describedby="inputGroupPrepend" required="">
                                        <?php if (validation_show_error('password')) : ?>
                                            <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('password'); ?>
                                                </span></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom02">Nik</label>
                                    <input class="form-control" id="nik" name="nik" type="text" maxlength="16" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                    <?php if (validation_show_error('nik')) : ?>
                                        <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('nik'); ?>
                                            </span></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom02">Telepon</label>
                                    <input class="form-control" id="no_hp" name="no_hp" maxlength="15" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                    <?php if (validation_show_error('no_hp')) : ?>
                                        <h6><span class="badge bg-danger text-white mt-2"> <?= validation_show_error('no_hp'); ?>
                                            </span></h6>
                                    <?php endif; ?>
                                </div>
                                <hr>
                                <!-- <div class="col-md-4">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input class="form-control" name="tempat_lahir" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input class="form-control" name="tanggal_lahir" type="date" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required="">
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                </div> -->
                            </div>

                            <br>
                            <button class="btn btn-primary" type="submit" onclick="getValue()">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>