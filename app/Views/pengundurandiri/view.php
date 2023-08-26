<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">

                </div>

            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">



                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 30px; text-align: center;">
                                                        <h6 style="font-weight: 600">Pengunduran Diri</h6>

                                                        <p>Total Simpanan Anda: Rp. <?= number_format($nominal) ?><br>
                                                        Untuk mengundurkan diri silahkan tekan button dibawah!</p>
                                                      
                                                        <button data-bs-toggle="modal" data-original-title="test" data-bs-target="#AmbilUang" type="button" title="Ambil Uang" class="btn btn-primary">
                                                            <i class="fa fa-users"> Ajukan Pengunduran Diri</i>
                                                        </button>
                                                        <!-- <p>Good luck! Hope it works.</p>
                                                            <p style="margin-bottom: 0">
                                                                Regards,<br>Webiots Software</p> -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                                <tbody>
                                                    <tr style="text-align: center">
                                                        <td>
                                                            <p style="color: #999; margin-bottom: 0">333 Woodland Rd. Baldwinsville, NY 13027</p>
                                                            <p style="color: #999; margin-bottom: 0">Don't Like These Emails?<a href="javascript:void(0)" style="color: #24695c">Unsubscribe</a></p>
                                                            <p style="color: #999; margin-bottom: 0">Powered By viho Admin</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> -->

                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AmbilUang" tabindex="-1" role="dialog" aria-labelledby="AmbilUangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AmbilUangLabel">Tarik Simpanan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('PengunduranDiri/request'); ?>" class="needs-validation" novalidate="" method="post">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <input type="text" name="id_user" id="id_user" value="<?= $users->id_user ?>" hidden>
                        <input type="text" name="nominal" id="nominal" value="<?= $nominal ?>" hidden>
                        <div class="col-md-12">
                            <label>Nama Lengkap</label>
                            <input class="form-control" id="nama_penerima" name="nama_penerima" type="text" required="">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-12">
                            <label>Nama Bank</label>
                            <input class="form-control" id="nama_bank" name="nama_bank" type="text" required="">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-12">
                            <label>No Rekening</label>
                            <input class="form-control" id="no_rekening" name="no_rekening" type="number" required="">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-12">
                            <label>Nominal</label>
                            <input class="form-control" id="" name="" type="text" required="" value="Rp. <?= number_format($nominal) ?>" readonly> 
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">Save changes</button>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endsection(); ?>