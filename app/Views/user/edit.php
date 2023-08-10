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
                        <form action="/user/edit_proses/<?= $data['id_user'] ?>" class="needs-validation" novalidate="" method="post">
                            <?= csrf_field() ?>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">Username</label>
                                    <input class="form-control" id="username" name="username" type="text" value="<?= $data['username'] ?>" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom02">Nama Lengkap</label>
                                    <input class="form-control" id="full_name" name="full_name" value="<?= $data['full_name'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" for="validationCustomUsername">Password</label>
                                    <div class="input-group">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="*******" aria-describedby="inputGroupPrepend">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom02">Nik</label>
                                    <input class="form-control" id="nik" name="nik" value="<?= $data['nik'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom02">Telepon</label>
                                    <input class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                            </div>
                            <br>
                            <button class="btn btn-primary" style="margin-left: 85%;" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>