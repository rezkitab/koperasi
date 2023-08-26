<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>
                        <div> Simpanan Wajib</div>
                    </h3>
                </div>

            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>

                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($riwayat_simpanan as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->nama_bulan ?></td>
                                            <td><?= $a->tahun ?></td>
                                            <td>Rp. <?= number_format($a->nominal, 0, ",", ".")  ?></td>
                                            <td><?php if ($a->status == 200) { ?>
                                                    Lunas
                                                <?php } elseif ($a->status == 201) { ?>
                                                    Pending
                                                <?php } else { ?>
                                                    Gagal
                                                <?php } ?></td>

                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <form id="payment-form" method="post" action="<?= site_url() ?>simpanan/pay_simpanan" class="needs-validation" novalidate="" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="card-title">Tambah Simpanan</div>
                            <div class="row">
                                <input hidden type="text" name="id_sim_wajib" value="<?= $id_sim_wajib ?>">
                                <input hidden type="text" name="tahun" value="<?= $tahun ?>">
                                <input type="hidden" name="result_type" id="result-type" value="">
                                <input type="hidden" name="result_data" id="result-data" value="">
                            </div>

                            <label>Bulan</label>
                            <select class="bootstrap-select strings selectpicker form-control" name="bulan" id="bulan" required="">
                                <option value="">Pilih Bulan</option>
                                <?php foreach ($bulan as $bl) { ?>

                                    <option value="<?= $bl->val ?>"> <?php echo $bl->nama_bulan; ?> </option>
                                <?php } ?>
                                <div class="valid-feedback">Looks good!</div>
                            </select>
                            <br>
                            <select class="form-control" id="pilih-nominal" title="Nominal" name="" required>
                                <option selected disabled>Pilih Nominal</option>
                                
                                <?php if ($firstNominal == 50000) { ?>
                                    <option value="50000" onclick="getNilai(50000)" readonly>Rp.50.000</option>
                                <?php } elseif ($firstNominal == 100000) { ?>
                                    <option value="100000" onclick="getNilai(100000)" readonly>Rp.100.000</option>
                                <?php } elseif ($firstNominal == 200000) { ?>
                                    <option value="200000" onclick="getNilai(200000)" readonly>Rp.200.000</option>
                                <?php } else { ?>
                                    <option value="50000" onclick="getNilai(50000)" readonly>Rp.50.000</option>
                                    <option value="100000" onclick="getNilai(100000)" readonly>Rp.100.000</option>
                                    <option value="200000" onclick="getNilai(200000)" readonly>Rp.200.000</option>
                                <?php } ?>

                            </select>

                            <!-- <a><input type="text" class="btn btn-info col-md-12" value="50000" onclick="getNilai(this.value)" readonly></a><br><br>
                            <input class="btn btn-info col-md-12" value="100000" onclick="getNilai(this.value)" readonly></button><br><br>
                            <input class="btn btn-info col-md-12" value="200000" onclick="getNilai(this.value)" readonly></input> -->


                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input name="nominal" id="nominal" class="form-control" type="text" value="" readonly required="">
                                <div class=" valid-feedback">Looks good!
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="button" id="pay-button" name="bayar" value="BAYAR" class="btn btn-success">Submit</button>
                                <a href="<?= base_url(
                                                'simpanan/simpanan_wajib'
                                            ) ?>" class="btn btn-danger">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript">
    // $('select option[value="01"]').attr("disabled", "disabled");
    // document.querySelector('select option[value="hand"]').disabled = true;
    var tot = <?= json_encode($jml_bulan) ?>;
    tot.forEach(function(index, data) {
        var responseNew = JSON.parse(index.total);
        console.log(responseNew)
        $("select option[value=" + responseNew + "]").attr("disabled", "disabled");
        if (responseNew == 10 || responseNew == 11 || responseNew == 12) {
            $("select option:contains( " + responseNew + ")").attr("disabled", "disabled");
        } else {
            $("select option:contains( " + 10 + ")").removeAttr("disabled");
            $("select option:contains( " + 11 + ")").removeAttr("disabled");
            $("select option:contains( " + 12 + ")").removeAttr("disabled");
        }
    })
</script>
<script>
    function getNilai(nilai) {
        // var value = text();
        $('#nominal').val(nilai);
        console.log(nilai)
    }

    $('#pilih-nominal').on('change', function(e) {
        e.preventDefault()
        let nilai = $(this).val()
        $('#nominal').val(nilai);
    })
</script>
<script src="<?= base_url() ?>/assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-a3XBeF6t11TJ5LWQ"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(e) {
        var _bulan = $('#bulan').val();
        var _total = $('#nominal').val();
        if (_bulan == "" ||
            _total == "") {
            alert("Bulan dan Nominal Harus diisi");
        } else {


            e.preventDefault();
            $(this).attr("disabled", "disabled");

            $.ajax({
                method: "POST",
                url: '<?= site_url() ?>snap_simpanan/token',
                data: {
                    bulan: _bulan,
                    total: _total
                },
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
    }
</script>

<?= $this->endsection(); ?>