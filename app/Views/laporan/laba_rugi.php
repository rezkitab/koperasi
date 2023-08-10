<?= $this->extend('layout/template', $title); ?>

<?php $this->section('content') ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Laba Rugi</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Laba Rugi</li>
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
                            <h4>Laba Rugi</h4>
                            <h5 id="periode-title">Periode</h5>
                        </div>
                        <div class="border-top"></div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-data">
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
    const reportTitle = 'Laba Rugi';
    const reportContent = $('#report-content');
    const tableData = $('#table-data');
    const formFilter = $('#form-filter');

    function format_number(x) {
        return new Intl.NumberFormat('de-DE').format(x)
    }

    function load_data(formData) {
        $.ajax({
            type: 'POST',
            url: "<?= site_url('laba-rugi') ?>",
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
                console.log(data);

                let pendapatan = data.pendapatan;
                let beban_operasional = data.beban_operasional;
                let beban_non_operasional = data.beban_non_operasional;

                let total_penjualan = 0;
                let total_beban_operasional = 0;
                let total_beban_non_operasional = 0;
                let cogs = 0;
                let gross_profit = 0;
                let profit = 0;
                // pendapatan
                html += `<tr class="text-bold">
                    <td class="text-primary" colspan="3" >Pendapatan</td>
                    <td class="text-primary text-end">IDR</td>
                </tr>`;
                html += `<tr class="text-bold">
                    <td></td>
                    <td class="text-primary"  colspan="2">Pendapatan Usaha</td>
                    <td></td>
                </tr>`;
                let total_saldo_debet = 0;
                let total_saldo_kredit = 0;
                for (let i = 0; i < pendapatan.length; i++) {
                    const line = pendapatan[i];
                    let saldo_kredit = 0;
                    let saldo_debet = 0;

                    if (line.saldo_normal == 'c') {
                        saldo_kredit = parseInt(line.kredit) - parseInt(line.debet);
                    } else {
                        saldo_debet = parseInt(line.debet) - parseInt(line.kredit);
                    }
                    total_saldo_debet += saldo_debet;
                    total_saldo_kredit += saldo_kredit;
                    html += `<tr>
                    <td></td>
                    <td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
                    <td class="text-end">${line.saldo_normal == 'c' ? format_number(saldo_kredit) + ',00' : '(' + format_number(saldo_debet) + ',00' + ')'}</td>
                </tr>`;
                }
                total_penjualan = total_saldo_kredit - total_saldo_debet;
                html += `<tr class="text-bold">
                    <td></td>
                    <td class="text-primary" colspan="2">Total Pendapatan Usaha</td>
                    <td class="text-end text-primary">${format_number(total_penjualan)},00</td>
                </tr>`;
                html += `<tr class="text-bold">
                    <td class="text-primary" colspan="3">Total Pendapatan</td>
                    <td class="text-end text-primary">${format_number(total_penjualan)},00</td>
                </tr>`;

                gross_profit = total_penjualan - cogs;
                html += `<tr class="text-bold">
                    <td class="text-danger" colspan="3">Laba/Rugi Kotor</td>
                    <td class="text-end text-danger">${format_number(gross_profit)},00</td>
                </tr>`;
                // END PENDAPATAN

                // BEBEN OPERASI
                html += `<tr class="text-bold">
                    <td class="text-primary" colspan="3" >Beban</td>
                    <td class="text-primary text-end"></td>
                </tr>`;
                html += `<tr class="text-bold">
                    <td></td>
                    <td class="text-primary"  colspan="2">Beban Operasional</td>
                    <td></td>
                </tr>`;

                for (let i = 0; i < beban_operasional.length; i++) {
                    const line = beban_operasional[i];
                    let saldo = parseInt(line.debet) - parseInt(line.kredit);
                    html += `<tr>
                            <td></td>
                            <td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
                            <td class="text-end">${format_number(saldo) + ',00'}</td>
                        </tr>`;
                    total_beban_operasional += saldo;
                }

                html += `<tr class="text-bold">
                        <td></td>
                        <td class="text-primary" colspan="2">Total Beban Operasional</td>
                        <td class="text-end text-primary">${format_number(total_beban_operasional)},00</td>
                    </tr>`;

                // END BEBAN OPERASIONAL
                html += `<tr class="text-bold">
                    <td></td>
                    <td class="text-primary"  colspan="2">Beban Non Operasional</td>
                    <td></td>
                </tr>`;

                for (let i = 0; i < beban_non_operasional.length; i++) {
                    const line = beban_non_operasional[i];
                    let saldo = parseInt(line.debet) - parseInt(line.kredit);
                    html += `<tr>
                        <td></td>
                        <td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ${line.kode_akun} - ${line.nama_akun}</td>
                        <td class="text-end">${format_number(saldo) + ',00'}</td>
                    </tr>`;
                    total_beban_non_operasional += saldo;
                }

                html += `<tr class="text-bold">
                    <td></td>
                    <td class="text-primary" colspan="2">Total Beban Non Operasional</td>
                    <td class="text-end text-primary">${format_number(total_beban_non_operasional)},00</td>
                </tr>`;

                // END BEBAN NON OPERASIONAL

                profit = gross_profit - (total_beban_operasional + total_beban_non_operasional);

                html += `<tr class="text-bold">
                    <td class="${profit >= 0 ? 'text-success' : 'text-danger'}" colspan="3">${profit >= 0 ? 'Laba Bersih' : 'Rugi'}</td>
                    <td class="text-end ${profit < 0 ? 'text-danger' : 'text-success'}">${format_number(profit)},00</td>
                </tr>`;


                // $('#data-content .title').html(results.title)
                $('#periode-title').text(results.periode)
                $('#table-data tbody').html(html);

                $('#report-content').show();
            }
        });
    }

    // // CLOSE FILTER
    // $('#filter-content').on('click', '#btn-close-filter', function(e) {
    //     // $('#data-content').show();
    //     $('#filter-content #btn-open-filter').show();
    //     $('#filter-content .card-footer').hide();
    //     $('#filter-content .card-body').hide();
    // });

    // // OPEN FILTER
    // $('#filter-content').on('click', '#btn-open-filter', function(e) {
    //     // $('#data-content').show();
    //     $('#filter-content #btn-open-filter').hide();
    //     $('#filter-content .card-footer').show();
    //     $('#filter-content .card-body').show();
    // });

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

    // $('#filter-content').on('click', '#btn-tampilkan-filter', function(e) {

    //     var periode = $('#periode').val();
    //     if (periode == '') {
    //         swal(
    //             'Error',
    //             'Periode harus di pilih!',
    //             'error'
    //         );
    //     } else {
    //         load_data(periode);
    //         $('#data-content').show();
    //         $('#filter-content #btn-open-filter').show();
    //         $('#filter-content .card-footer').hide();
    //         $('#filter-content .card-body').hide();
    //     }

    // });
</script>
<?php $this->endSection() ?>