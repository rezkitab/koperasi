<?= $this->extend('layout/template', $title); ?>

<?php $this->section('content') ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Data Akun (Chart Of Account)</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Master Data</li>
                        <li class="breadcrumb-item active">Data Akun</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <!-- Bookmark Start-->
                    <div class="bookmark">
                        <button class="btn btn-primary btn-iconsolid" id="btn-tambah">
                            <span> Tambah Data</span>
                        </button>
                    </div>
                    <!-- Bookmark Ends-->
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="data-content">
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive table-hover table-striped" id="table-data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10%">Kode</th>
                                    <th width="20%">Nama</th>
                                    <th width="10%">Header</th>
                                    <th width="10%">Saldo Normal</th>
                                    <th width="10%">Posted</th>
                                    <th width="10%">Arus Kas</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="form-content" style="display: none">
        <div class="row">
            <div class="col-xl-7 col-md-7 col-sm-12 mx-auto">
                <form action="" method="post" enctype="multipart/form-data" id="form-tambah">
                    <input type="hidden" name="inp_type" id="inp-type" class="inp-type" value="post">
                    <div class="card">

                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-xl-12 col-sm-12">
                                    <h5 class="card-title" id="form-title">Tambah Data Akun</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="kode">Kode Akun</label>
                                        <input type="text" name="kode" id="kode" class="form-control" minlength="4" maxlength="10" required>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Akun</label>
                                        <input type="text" name="nama" id="nama" class="form-control" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_id">Header Akun</label>
                                        <select name="sub_id" id="sub_id" class="form-control" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="activity_id">Aktivitas Arus Kas</label>
                                        <select name="activity_id" id="activity_id" class="form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="dc">Saldo Normal</label>
                                        <select name="dc" id="dc" class="form-control" required>
                                            <option value="d">Debet</option>
                                            <option value="c">Kredit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="posted">Posted</label>
                                        <select name="posted" id="posted" class="form-control" required>
                                            <option value="nrc">Neraca</option>
                                            <option value="l/r">Laba/Rugi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-danger" type="button" id="btn-batal">Batal</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div styp>
</div>
<?php $this->endSection() ?>

<?php $this->section('custom-js') ?>
<script>
    const dataContent = $('#data-content');
    const tableData = $('#table-data');
    const btnTambah = $('#btn-tambah');
    const formContent = $('#form-content');
    const formTambah = $('#form-tambah');
    const btnBatal = $('#btn-batal');

    $(document).ready(function(e) {
        load_data();
        dataContent.show();
        formContent.hide();
    })
    let actionHtml = `<a href="javascript:void()" class="text-warning" id="btn-edit">
        <i class="fa fa-edit"></i> Edit
    </a>`;
    let dataTables = tableData.DataTable({
        sort: false,
        ordering: false,
        paging: true,
        info: false,
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Semua"]
        ],
        "iDisplayLength": 25,
        "language": {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            search: "Cari Data",
            info: "Halaman _PAGE_ dari _PAGES_",
            zeroRecords: "Data Tidak Ditemukan",
            infoEmpty: "Tidak ada data",
        },
        "columnDefs": [{
                "searchable": true,
                "orderable": false,
                "targets": 0,
                "className": 'text-left'
            },
            {
                "searchable": true,
                "orderable": false,
                "targets": 6,
                "className": 'text-center',
                'defaultContent': actionHtml
            }
        ],
        "columns": [{
                'data': 'kode'
            },
            {
                'data': 'nama'
            },
            {
                'data': 'header',
            },
            {
                'data': 'dc',
                render: function(data) {
                    if (data == 'd') {
                        return 'Debet'
                    }

                    return 'Kredit'
                }
            },
            {
                'data': 'posted',
                render: function(data) {
                    if (data == 'nrc') {
                        return 'Neraca'
                    }
                    return 'Laba/Rugi'
                }
            },
            {
                'data': 'activity',
                render: function(data) {
                    if (data !== null) {
                        return data
                    }

                    return '-'
                }
            },
            {
                'data': null
            }
        ]
    });

    const formTambahTitle = 'Tambah Data Akun';
    const formEditTitle = 'Edit Data Akun';

    const load_data = () => {
        dataTables.clear().draw();
        $.ajax({
            type: 'GET',
            url: "<?= site_url('coa') ?>",
            dataType: 'json',
            success: function(res) {
                dataTables.rows.add(res).draw(false)
            },
        });
    }

    btnTambah.on('click', function(e) {
        e.preventDefault();
        getSubHead();
        getActivity();
        formTambah.find('.inp-type').val('post');
        formTambah.find('#kode').attr('readonly', false);
        console.log('button tambah clicked!');
        formTambah.find('#form-title').text(formTambahTitle);
        dataContent.hide();
        formContent.show();
        btnTambah.hide();
    })

    btnBatal.on('click', function(e) {
        e.preventDefault();
        load_data();
        resetFormTambah();
        dataContent.show();
        formContent.hide();
        btnTambah.show();

    })

    tableData.on('click', '#btn-edit', function(e) {
        e.preventDefault();
        console.log('edit button clicked');
        let id = $(this).closest('tr').find('td').eq(0).html();
        editData(id);
    })

    const editData = (id) => {
        getSubHead();
        getActivity();
        formTambah.find('#kode').attr('readonly', true);
        $.ajax({
            type: 'GET',
            url: "<?= site_url('coa/find') ?>",
            data: {
                kode: id
            },
            dataType: 'json',
            success: function(res) {
                let data = res;
                console.log(data);

                formTambah.find('.inp-type').val('edit');
                formTambah.find('#kode').val(data.kode);
                formTambah.find('#nama').val(data.nama);
                formTambah.find('#sub_id').val(data.sub_id);
                formTambah.find('#activity_id').val(data.activity_id);
                formTambah.find('#dc').val(data.dc);
                formTambah.find('#posted').val(data.posted);
                formTambah.find('#form-title').text(formEditTitle);
                dataContent.hide();
                formContent.show();
                btnTambah.hide();
            },
        });
    }

    const getSubHead = () => {
        $.ajax({
            type: 'get',
            url: '<?= site_url('/coa/subhead') ?>',
            dataType: 'json',
            success: function(res) {
                let html = '';

                if (res.length > 0) {
                    for (let i = 0; i < res.length; i++) {
                        html += `<option value="${res[i].kode}">${res[i].kode} - ${res[i].nama}</option>`
                    }
                }

                $('#form-tambah').find('#sub_id').html(html);
            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    const getActivity = () => {
        $.ajax({
            type: 'get',
            url: '<?= site_url('/coa/activity') ?>',
            dataType: 'json',
            success: function(res) {
                let html = '';
                html += `<option value="">-- pilih --</option>`
                if (res.length > 0) {
                    for (let i = 0; i < res.length; i++) {
                        html += `<option value="${res[i].kode}">${res[i].kode} - ${res[i].nama}</option>`
                    }
                }

                $('#form-tambah').find('#activity_id').html(html);
            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    formTambah.validate({
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
            let type = formTambah.find('.inp-type').val();
            saveData(formData, type);
        }
    })

    const saveData = (formData, type) => {
        let requestType = 'post';

        if (type == 'edit') {
            requestType = 'put';
            formData.append('_method', 'PUT');
        }

        console.log(requestType)

        $.ajax({
            type: 'post',
            url: "<?= site_url('coa') ?>",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(res) {
                let notif = res.results.notif;
                if (res.status) {
                    console.log(res);
                    formTambah.find('.inp-type').val('post');
                    resetFormTambah();
                    load_data();
                    dataContent.show();
                    formContent.hide();
                    btnTambah.show();
                }
                swal(
                    notif.title,
                    notif.message,
                    notif.icon
                );
            },
            error: function(err) {
                console.log(err);
            }
        })
    }
</script>
<?php $this->endSection() ?>