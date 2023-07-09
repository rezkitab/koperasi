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
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <a href="/simpanan_manasuka" class="btn btn-primary" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Kembali</a>
                    </div>
                    <div class="card-body">
                        <form id="payment-form" action="<?= base_url('simpanan/pay_manasuka'); ?>" class="needs-validation" novalidate="" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>Nominal</label>
                                    <input class="form-control" id="nominal" onkeyup="getvalue(this.value)" type="text" required="">
                                    <input hidden class="form-control" id="rp" name="nominal" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                            </div>
                            <br>
                            <button class="btn btn-primary" id="pay-button" style="margin-left: 75%;" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getvalue(value) {
        var nilai = value.replace(/[^0-9]/g, '');
        $('#rp').val(nilai);
        // console.log(nilai);
    }
</script>
<script type="text/javascript">
    var rupiah = document.getElementById('nominal');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-a3XBeF6t11TJ5LWQ"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(e) {
        e.preventDefault();
        $(this).attr("disabled", "disabled");
        var _nominal = $('#rp').val();
        $.ajax({
            method: "POST",
            url: '<?= site_url() ?>snap_manasuka/token',
            cache: false,
            data: {
                nominal: _nominal
            },
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