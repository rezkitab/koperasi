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
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="">Anggota</label>
                                    <select class="bootstrap-select strings selectpicker form-control" name="id_user" id="id_user" required="">
                                        <option value="">Pilih Anggota</option>
                                        <?php foreach ($users as $us) { ?>

                                            <option value="<?= $us->id_user ?>"> <?php echo $us->full_name; ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="">From</label>
                                    <input type="date" name="dateOne" class="form-control" id="dateOne" value="AUTO" required>

                                </div>
                                <div class="col-sm-3">
                                    <label for="">To</label>
                                    <input type="date" name="dateTwo" class="form-control" id="dateTwo" value="AUTO" required>

                                </div>
                                <div class="col-sm-2" style="margin-top: 2%;">
                                    <button class="form-control btn btn-primary" onclick="searchManasuka()" style="color: white;">Cari</button>
                                </div>
                                <div class="col-sm-2" style="margin-top: 2%;">
                                    <a href="/LaporanController/simpanan_manasuka" class="form-control btn btn-warning" style="color: white;">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pb-2">
                                        <div class="row">
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <b>KOPERASI SYARIAH</b>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <b>LAPORAN SIMPANAN MANASUKA</b>
                                            </div>
                                            <div class="col-sm-12" style="background-color:white;" align="center">
                                                <b>Periode</b>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <?php if ($id_user != "") { ?>
                                                <a target="_blank" href="/LaporanController/pdf_manasuka/<?= $id_user ?>/<?= $tgl_bayar ?>" class="form-control btn btn-danger" style="color: white; width: 10%">PDF</a>
                                            <?php } else { ?>
                                                <button onclick="exportPdf()" class="form-control btn btn-danger" style="color: white; width: 10%">PDF</button>

                                            <?php }  ?>
                                            <br>
                                            <br>
                                            <table class="display" id="basic-1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Penarikan</th>
                                                        <th>Nama Bank</th>
                                                        <th>No Rekening</th>
                                                        <th>Jenis</th>
                                                        <th>Status</th>
                                                        <th>Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="show_data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function searchManasuka() {
        $.ajax({
            url: "<?php echo base_url("LaporanController/load_data_manasuka"); ?>",
            type: "POST",
            data: {
                id_user: $("#id_user").val(),
                dateOne: $("#dateOne").val(),
                dateTwo: $("#dateTwo").val(),

            },
            cache: false,
            success: function(res) {

                var obj = JSON.parse(res);
                // console.log(obj.total.total);
                var html = '';
                var i;
                var no = 1;
                var button =
                    '<a herf="" type="submit" class="btn btn-primary" id="edit" value="save">Edit</a>';
                for (i = 0; i < obj.data.length; i++) {
                    html += '<tr>' +
                        '<td>' + no++ + '</td>' +
                        '<td>' + obj.data[i].full_name + '</td>' +
                        '<td>' + obj.data[i].tgl_penarikan + '</td>' +
                        '<td>' + obj.data[i].nama_bank + '</td>' +
                        '<td>' + obj.data[i].no_rekening + '</td>' +
                        '<td>' + obj.data[i].jenis + '</td>' +

                        '<td>' + '' +
                        ((obj.data[i].status == 1) ?
                            'Berhasil' :
                            (obj.data[i].status == 2) ?
                            'Pending' : 'Gagal') +
                        '</td>' +
                        '<td>' + '' +
                        ((obj.data[i].jenis == "Masuk") ?
                            'Rp. ' + number_format(obj.data[i].nominal_tarik) :
                            'Rp. ' + number_format(obj.data[i].nominal_tarik)) +
                        '</td>' +
                        '</tr>';
                }
                $('#show_data').html(html);
                $("#total").html('Rp. ' + number_format(obj.total.total));
            }
        });
    }

    function exportPdf() {
        var id_user = $("#id_user").val();
        var dateOne = $("#dateOne").val();
        var dateTwo = $("#dateTwo").val();
        // console.log(id_bulan_m);
        $.ajax({
            url: "<?php echo base_url("/LaporanController/pdf_manasuka"); ?>",
            type: "POST",
            data: {
                id_user: id_user,
                dateOne: dateOne,
                dateTwo: dateTwo,
            },
            cache: false,
            success: function(res) {

                var obj = JSON.parse(res);
                console.log(obj.data);
                var url = "<?= base_url("/LaporanController/pdf_manasuka_view") ?>" + '?id_user=' + obj.id_user + '&dateOne=' + obj.dateOne + '&dateTwo=' + obj.dateTwo + '';
                window.open(url, "_blank");

            }
        });


    }
</script>
<?= $this->endsection(); ?>