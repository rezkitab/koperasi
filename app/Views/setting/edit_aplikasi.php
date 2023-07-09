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
                        <form action="/setting/update" class="needs-validation" novalidate="" method="post">
                            <?= csrf_field() ?>
                            <input id="id" name="id" value="<?= $data['id'] ?>" type="text" class="form-control" placeholder="fill name" hidden>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Nama Owner</label>
                                    <input class="form-control" id="nama_owner" name="nama_owner" type="text" value="<?= $data['nama_owner'] ?>" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-4">
                                    <label>Alamat</label>
                                    <input class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-6">
                                    <label>Title</label>
                                    <input class="form-control" id="title" name="title" value="<?= $data['title'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom02">Telepon</label>
                                    <input class="form-control" id="tlp" name="tlp" value="<?= $data['tlp'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-12">
                                    <label>Nama Aplikasi</label>
                                    <input class="form-control" id="nama_aplikasi" name="nama_aplikasi" value="<?= $data['nama_aplikasi'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Logo</label>
                                    <input class="form-control" name="file" id="file" value="UPLOAD" type="file">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Copy Right</label>
                                    <input class="form-control" id="copy_right" name="copy_right" value="<?= $data['copy_right'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Versi</label>
                                    <input class="form-control" id="versi" name="versi" value="<?= $data['versi'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Tahun</label>
                                    <input class="form-control" id="tahun" name="tahun" value="<?= $data['tahun'] ?>" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                            </div>
                            <br>
                            <button class="btn btn-primary" style="margin-left: 85%;" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>