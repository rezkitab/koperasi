<?= $this->extend('layout/template', $title); ?>

<?php $this->section('content') ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Arus Kas</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Arus Kas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="data-content">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="row gy-2 gx-3 align-items-center" id="form-filter">
                            <div class="col-auto">
                                <label class="visually-hidden" for="autoSizingInput">Periode</label>
                                <input name="periode" class="datepicker-here form-control" type="text" data-language="en" data-min-view="months" data-view="months" data-date-format="yyyy-mm" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Lihat Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Content-->
        <div class="row my-3" id="report-content" style="display: none;">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h3>Koperasi Syariah</h3>
                            <h4>Arus Kas</h4>
                            <h5 id="periode-title">Periode</h5>
                        </div>
                        <div class="border-top"></div>
                        <div class="table-responsive">
                            <table id="table-data" class="table">
                                <tbody>

                                </tbody>
                            </table>
                            <table class="table mt-4" id="table-data-summary">
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
    $('#periode').datepicker()
</script>
<script>
    const reportTitle = 'Arus Kas';
    const reportContent = $('#report-content');
    const tableData = $('#table-data');
    const formFilter = $('#form-filter');

    function format_number(x) {
        return new Intl.NumberFormat('de-DE').format(x)
    }

    function load_data(formData) {
        $.ajax({
            type: 'post',
            url: "<?= site_url('/arus-kas') ?>",
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

                let cf = data.cf
                for (let y = 0; y < cf.length; y++) {
                    const line1 = cf[y];
                    html += `<tr style="background-color: #f8f9fa">
                        <td colspan="2" class="text-primary">${line1.nama}</td>
                    </tr>`
                    let subheader = line1.subheader
                    for (let i = 0; i < subheader.length; i++) {
                        const line11 = subheader[i]
                        let totalItems = 0;
                        html += `<tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${line11.kode_akun} - ${line11.nama_akun}</td>
                                <td class="text-end">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${line11.saldo}</td>
                            </tr>`
                    }
                    html += `<tr style="border-top:solid 2px">
                            <td class="text-primary">&nbsp;&nbsp;&nbsp;${line1.label}</td>
                            <td class="text-primary text-end">&nbsp;&nbsp;&nbsp;${line1.saldo}</td>
                        </tr>`
                }
                let html2 = '';
                let summary = data.summary;
                html2 += `<tr style="border-top:solid 2px;">
                        <td class="text-primary">Kenaikan (Penurunan) Kas</td>
                        <td class="text-primary text-end">${summary.kenaikan_penuruan_kas}</td>
                    </tr>`
                html2 += `<tr>
                        <td class="text-primary">Saldo Awal Kas ${info.periode}</td>
                        <td class="text-primary text-end">${summary.saldo_awal_kas}</td>
                    </tr>`

                html2 += `<tr style="border-top:solid 2px;border-bottom:solid 2px;">
                        <td class="text-primary">Saldo Akhir Kas & Bank ${info.periode}</td>
                        <td class="text-primary text-end">${summary.saldo_akhir_kas}</td>
                    </tr>`



                $('#table-data tbody').html(html);
                $('#table-data-summary tbody').html(html2);

                reportContent.find('#periode-title').text(info.periode);
                reportContent.find('#modul-title').text(info.modul);
                reportContent.show();
            },
        });
    }



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