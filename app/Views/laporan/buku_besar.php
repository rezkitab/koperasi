<?= $this->extend('layout/template', $title); ?>

<?php $this->section('content') ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Buku Besar</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Buku Besar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <!-- data content    -->
        <div class="row" id="data-content">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <form action="" id="form-filter">
                        <div class="card-body">
                            <div class="card-title">Filter Buku Besar</div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Periode</label>
                                <div class="col-sm-10">
                                    <input name="periode" class="datepicker-here form-control" type="text" data-language="en" data-min-view="months" data-view="months" data-date-format="yyyy-mm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Akun</label>
                                <div class="col-sm-10">
                                    <select name="kode_akun" id="kode_akun" class="form-control select2" style="width: 100%">
                                        <option value="all">0000 - SEMUA AKUN</option>
                                        <?php foreach ($akun as $row) : ?>
                                            <option value="<?= $row['kode'] ?>"><?= $row['kode'] . ' - ' . $row['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success">Tampilkan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Report Content -->

        <!-- Report Content-->
        <div class="row my-3" id="report-content">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h3>Koperasi Syariah</h3>
                            <h4>Buku Besar</h4>
                            <h5 id="periode-title">Periode</h5>
                            <h6>(dalam IDR)</h6>
                        </div>
                        <div class="border-top"></div>
                        <div class="table-responsive tableFixHead">
                            <table class="table table-hover table-bordered " id="table-data">
                                <thead>
                                    <tr class="text-nowrap text-center">
                                        <th rowspan="2">Nama Akun / Tanggal</th>
                                        <th rowspan="2">Transaksi</th>
                                        <th rowspan="2">Nomor</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th colspan="2">&nbsp;</th>
                                        <th colspan="2">Saldo</th>
                                    </tr>
                                    <tr class="text-center">
                                        <!--Pergerakan-->
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <!--saldo-->
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection() ?>

<?php $this->section('custom-js') ?>
<script>
    const reportTitle = 'Jurnal Umum';
    const reportContent = $('#report-content');
    const tableData = $('#table-data');
    const formFilter = $('#form-filter');

    const load_data = (formData) => {
        $.ajax({
            type: 'post',
            url: "<?= site_url('/buku-besar') ?>",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                let response = res.results;
                let data = response.data;
                let info = response.info;
                console.log(data)

                let html = '';

                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let line = data[i]
                        html += `<tr>`
                        html += `<td class="text-nowrap text-bold " style="background-color: rgba(36, 105, 92, 0.2);" colspan="8">(${line.kode_akun}) ${line.nama_akun}</td>`
                        html += `</tr>`

                        html += `<tr>
                            <td colspan="3"></td>
                            <td colspan="3">Saldo Awal (${line.kode_akun}) ${line.nama_akun}</td>
                            <td class="text-end text-nowrap">${line.saldo_normal == 'd' ? line.saldo_awal : '0,00'}</td>
                            <td class="text-end text-nowrap">${line.saldo_normal == 'c' ? line.saldo_awal : '0,00'}</td>
                        </tr>`

                        let detail = line.detail
                        for (let y = 0; y < detail.length; y++) {
                            let line2 = detail[y]
                            html += `<tr>`
                            html += `<td class="text-end">${line2.tanggal}</td>`
                            html += `<td class="text-nowrap">${line2.transaksi}</td>`
                            html += `<td class="text-nowrap">${line2.nomor}</td>`
                            html += `<td>${line2.keterangan}</td>`
                            html += `<td class="text-end text-nowrap">${line2.debet}</td>`
                            html += `<td class="text-end text-nowrap">${line2.kredit}</td>`
                            html += `<td class='text-end'>${line2.saldo_normal === 'd' ? line2.saldo : '0,00'}</td>`
                            html += `<td class='text-end'>${line2.saldo_normal === 'c' ? line2.saldo : '0,00'}</td>`
                            html += `</tr>`
                            console.log(line2.saldo_normal)
                        }

                        let akhir = line.akhir
                        html += `<tr>
                            <td colspan="6" class="text-nowrap text-end text-bold">(${line.kode_akun}) ${line.nama_akun} | Saldo Akhir</td>
                            <td class="text-end text-nowrap text-bold">${line.saldo_normal == 'd' ? akhir.saldo_akhir : '0,00'}</td>
                            <td class="text-end text-nowrap text-bold">${line.saldo_normal == 'c' ? akhir.saldo_akhir : '0,00'}</td>
                        </tr>`
                    }
                } else {
                    html += `<tr>
                        <td colspan="8" class="text-center">--Data Tidak Ditemukan--</td>
                    </tr>`;
                }
                $('#table-data tbody').html(html);

                reportContent.find('#periode-title').text(info.periode);
                reportContent.find('#modul-title').text(info.modul);
                reportContent.show();
            },
        });
    }



    //form tambah on submit
    formFilter.validate({
        errorClass: "control-label",
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent().removeClass('has-error');
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let formData = new FormData(form);
            load_data(formData)
        }
    })
</script>
<?php $this->endSection() ?>