<?= $this->extend('layout/template', $title); ?>

<?php $this->section('content') ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Jurnal Umum</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Jurnal Umum</li>
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
                            <h4>Jurnal Umum</h4>
                            <h5 id="periode-title">Periode</h5>
                        </div>
                        <div class="border-top"></div>
                        <div class="table-responsive">
                            <table class="table  mt-4" id="table-data">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Ref</th>
                                        <th class="text-end">Debet <br> <small><i>(*dalam IDR)</i></small> </th>
                                        <th class="text-end">Kredit <br> <small><i>(*dalam IDR)</i></small></th>
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
    $('#periode').datepicker()
</script>
<script>
    const reportTitle = 'Jurnal Umum';
    const reportContent = $('#report-content');
    const tableData = $('#table-data');
    const formFilter = $('#form-filter');

    const load_data = (formData) => {
        $.ajax({
            type: 'post',
            url: "<?= site_url('/jurnal-umum') ?>",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                let data = res.data;
                let info = res.info;
                console.log(data)

                let html = '';

                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let line = data[i];

                        html += `<tr>
                             <td>${line.tanggal}</td>`;
                        html += `<td>
                                 <p class="mt-0 mb-0"> ${line.keterangan}</p>`
                        let det = line.detail;
                        for (let y = 0; y < det.length; y++) {

                            html += ` <p class="mt-3 mb-0">${det[y].keterangan}</p>`;
                        }
                        html += `</td>`;
                        html += `<td>
                            <p class="mt-0 mb-0">&nbsp;</p>`
                        let det1 = line.detail;
                        for (let d = 0; d < det1.length; d++) {

                            html += ` <p class="mt-3 mb-0">${det1[d].no_bukti}</p>`;
                        }
                        html += `</td>`

                        html += `<td class="text-end">
                            <p class="mt-0 mb-0">&nbsp;</p>`
                        let det2 = line.detail;
                        for (let y = 0; y < det2.length; y++) {

                            html += ` <p class="mt-3 mb-0">${det2[y].debet == 0 ? '&nbsp;' : number_to_price2(det2[y].debet)}</p>`;
                        }
                        html += `</td>`
                        html += `<td class="text-end">
                            <p class="mt-0 mb-0">&nbsp;</p>`
                        let det3 = line.detail;
                        for (let y = 0; y < det3.length; y++) {

                            html += ` <p class="mt-3 mb-0">${det3[y].kredit == 0 ? '&nbsp' : number_to_price2(det3[y].kredit)}</p>`;
                        }
                        html += `</td>`

                        html += `</tr>`
                    }
                } else {
                    html += `<tr>
                        <td colspan="5" class="text-center">--Data Tidak Ditemukan--</td>
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