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


                        <form id="payment-form" action="<?= base_url('simpanan/pay'); ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                            <input type="text" name="id_user[]" id="id_user" value="<?= $getsimpanan['id_user'] ?>" hidden>
                            <table style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>


                                            <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 30px">
                                                            <h6 style="font-weight: 600">Simpanan Pokok</h6>
                                                            <p>Selamat datang <?= $username ?>, Anda <?php if ($getsimpanan['status'] == 1) { ?>
                                                                    Sudah
                                                                <?php } else { ?>
                                                                    Belum
                                                                <?php } ?> membayar simpanan pokok sebesar <b>Rp.100.000</b>. <?php if ($getsimpanan['status'] == 1) { ?>

                                                                <?php } else { ?>
                                                                    Segeralah Membayar Simpanan Pokok Anda!
                                                                <?php } ?></p>
                                                            <p style="text-align: center">
                                                                <?php if ($getsimpanan['order_id'] != null) { ?>
                                                                    <a href="<?= $getsimpanan['pdf_url'] ?>" style="padding: 10px; background-color: #24695c; color: #fff; display: inline-block; border-radius: 4px;font-weight:600;">Invoice</a>
                                                                    <?php if ($getsimpanan['status'] != 1) { ?>
                                                                        <a href="<?= base_url('Notification/cektransaksi'); ?>" style="padding: 10px; background-color: #24695c; color: #fff; display: inline-block; border-radius: 4px;font-weight:600;">Cek Transaksi</a>
                                                                    <?php } ?>
                                                                <?php } elseif($getsimpanan['status'] == 1) { ?>
                                                                    <a href="#" style="padding: 10px; background-color: #24695c; color: #fff; display: inline-block; border-radius: 4px;font-weight:600;">Lunas</a>
                                                              <?php } else { ?>
                                                                    <button type="submit" id="pay-button" style="padding: 10px; background-color: #24695c; color: #fff; display: inline-block; border-radius: 4px;font-weight:600;">BAYAR SIMPANAN POKOK</button>
                                                                <?php } ?>

                                                            </p>
                                                            <!-- <p>If you have remember your pay simpanan you can click button pay.</p>
                                                            <p>Good luck! Hope it works.</p>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-a3XBeF6t11TJ5LWQ"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(e) {
        e.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajax({
            method: "POST",
            url: '<?= site_url() ?>snap/token',
            cache: false,
            success: function(data) {
                console.log('token = ' + data);
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                }
                snap.pay(data, {
                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    };
</script>

<?= $this->endsection(); ?>