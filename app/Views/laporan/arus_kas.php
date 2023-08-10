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
            url: "<?= site_url('/arus-kas') ?>",
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

                let pendapatan = data.pendapatan;
                let beban = data.beban;
                let investing = data.investing;
                let financing = data.financing;
                let total_operasi = 0;

                let debet_pendapatan = 0;
                let kredit_penedapatan = 0;

                let debet_beban = 0;
                let kredit_beban = 0;


                let debet_investing = 0;
                let kredit_investing = 0;


                let debet_financing = 0;
                let kredit_financing = 0;

                let total_pendapatan = 0;
                let total_beban = 0;
                let total_investing = 0;
                let total_financing = 0;

                let total_cf = 0;
                let saldo_akhir = 0;
                html += `<tr class="text-bold">
					<td class="text-primary" colspan="2">Operating Activities</td>
					<td class="text-primary text-end">IDR</td>
				</tr>`;


                for (let i = 0; i < pendapatan.length; i++) {
                    const line = pendapatan[i];

                    html += `<tr>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
						<td class="text-end">${line.saldo_normal == 'D' ? '(' + format_number(line.debet)+',00)' : format_number(line.kredit) + ',00'}</td>
					</tr>`;
                    debet_pendapatan += parseInt(line.debet);
                    kredit_penedapatan += parseInt(line.kredit);
                }
                total_pendapatan = kredit_penedapatan - debet_pendapatan;

                for (let i = 0; i < beban.length; i++) {
                    const line = beban[i];
                    html += `<tr>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
						<td class="text-end">${line.saldo_normal == 'd' ? '(' + format_number(line.debet)+',00)' : format_number(line.kredit) + ',00'}</td>
					</tr>`;
                    debet_beban += parseInt(line.debet);
                    kredit_beban += parseInt(line.kredit);
                }
                total_beban = debet_beban - kredit_beban;
                total_operasi = total_pendapatan - total_beban;
                html += `<tr class="text-bold">
					<td></td>
					<td class="text-primary">Total Operating Activities</td>
					<td class="text-end text-primary">${format_number(total_operasi) + ',00'}</td>
				</tr>`;



                html += `<tr class="text-bold">
					<td class="text-primary" colspan="3">Investing Activities</td>
				</tr>`;
                for (let i = 0; i < investing.length; i++) {
                    const line = investing[i];
                    html += `<tr>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
						<td class="text-end">${line.saldo_normal == 'C' ? '(' + format_number(line.kredit)+',00)' : format_number(line.debet) + ',00'}</td>
					</tr>`;
                    debet_investing += parseInt(line.debet);
                    kredit_investing += parseInt(line.kredit);
                }
                total_investing = debet_investing - kredit_investing;
                html += `<tr class="text-bold">
					<td></td>
					<td class="text-primary">Total Investing Activities</td>
					<td class="text-end text-primary">(${format_number(total_investing) + ',00'})</td>
				</tr>`;



                html += `<tr class="text-bold">
					<td class="text-primary" colspan="3">Financing Activities</td>
				</tr>`;
                for (let i = 0; i < financing.length; i++) {
                    const line = financing[i];
                    html += `<tr>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
						<td class="text-end">${line.saldo_normal == 'D' ? '(' + format_number(line.debet)+',00)' : format_number(line.kredit) + ',00'}</td>
					</tr>`;
                    debet_financing += parseInt(line.debet);
                    kredit_financing += parseInt(line.kredit);
                }
                total_financing = kredit_financing - debet_financing;
                html += `<tr class="text-bold">
					<td></td>
					<td class="text-primary">Total Financing Activities</td>
					<td class="text-end text-primary">${format_number(total_financing) + ',00'}</td>
				</tr>`;


                total_cf = (total_operasi - total_investing) + total_financing;
                html += `<tr class="text-bold">
					
					<td class="text-primary" colspan="2">Total Arus Kas & Bank</td>
					<td class="text-end text-primary">${format_number(total_cf) + ',00'}</td>
				</tr>`;

                html += `<tr class="text-bold">
					<td class="text-primary" colspan="2">Saldo Awal Kas & Bank</td>
					<td class="text-end text-primary">${format_number(data.saldo_awal) + ',00'}</td>
				</tr>`;

                saldo_akhir = total_cf + data.saldo_awal;

                html += `<tr class="text-bold">
					<td class="text-primary" colspan="2">Saldo Akhir Kas & Bank</td>
					<td class="text-end text-primary">${format_number(saldo_akhir) + ',00'}</td>
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