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
                            <h4>Neraca Saldo</h4>
                            <h5 id="periode-title">Periode</h5>
                        </div>
                        <div class="border-top"></div>
                        <div class="table-responsive">
                            <table id="table-data" class="table  table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Akun</th>
                                        <th>Nama Akun</th>
                                        <th class="text-end">Debet</th>
                                        <th class="text-end">Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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
            type: 'POST',
            url: "<?= site_url('neraca-saldo') ?>",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {

                let html = '';
                let results = res.results;
                let data = results.values;
                let total_debet = 0;
                let total_kredit = 0;
                for (let i = 0; i < data.length; i++) {
                    const line = data[i];
                    html += `<tr>
						<td>${line.kode_akun}</td>
						<td>${line.nama_akun}</td>
						<td class="text-end">${format_number(line.saldo_debet) + ',00'}</td>
						<td class="text-end">${format_number(line.saldo_kredit) + ',00'}</td>
					</tr>`;
                    total_debet += parseInt(line.saldo_debet);
                    total_kredit += parseInt(line.saldo_kredit);
                }

                html += `<tr style="background-color: #adb5bd; font-weight: bold;">
					<td colspan="2">Total</td>
					<td class="text-end">${format_number(total_debet) + ',00'}</td>
					<td class="text-end">${format_number(total_kredit) + ',00'}</td>
				</tr>`;

                $('#periode-title').text(results.periode)
                $('#table-data tbody').html(html);

                $('#report-content').show();
            }
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