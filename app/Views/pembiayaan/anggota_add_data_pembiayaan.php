<?= $this->extend('layout/template', $title); ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3><?= $title ?></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pembiayaan/anggota') ?>">Pembiayaan</a></li>
                        <li class="breadcrumb-item active">Tambah Data Pengajuan Pembiayaan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body pt-0">
                        <form action="<?= base_url('pembiayaan/anggota_create') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Kode Pembiayaan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" value="<?= $kode_pembiayaan ?>" name="kode_pembiayaan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Tgl Pembiayaan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" value="<?= date('d-M-Y') ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Anggota</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                                <input class="form-control form-control-sm" type="text" value="<?= $anggota->full_name; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Nama Barang</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" value="<?= old('nama_barang'); ?>" name="nama_barang" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Jenis Pembiayaan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" value="Murabahah" name="jenis_pembiayaan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Jumlah Pembiayaan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm jumlah_pembiayaan" type="text" name="jumlah_pembiayaan" autocomplete="off" id="jumlah_pembiayaan" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Angsuran</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="number" name="angsuran" value="<?= old('angsuran'); ?>" autocomplete="off" id="angsuran" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Margin</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input class="form-control form-control-sm" type="text" value="5%" name="margin" readonly>
                                                    <!-- <span class="input-group-text">%</span> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Biaya Administrasi</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" value="<?= nominal_(340000) ?>" name="biaya_administrasi" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Total Angsuran</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" name="total_angsuran" readonly id="total_angsuran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 row">
                                            <label class="col-sm-3 col-form-label">Total Pembiayaan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" type="text" name="total_pembiayaan" readonly id="total_pembiayaan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="maks_pembiayaan">
                            <input type="hidden" id="agt" value="<?= $user_id ?>">
                            <div class="card-footer text-end">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="<?= base_url('pembiayaan') ?>" class="btn btn-light btn-sm">Kembali</a>
                                    <button class="btn btn-primary btn-sm" type="submit" id="proses">Submit</button>
                                </div>
                            </div>
                        </form>
                        <span>"margin, biaya adm dan jumlah angsuran mungkin saja berubah tergantung dengan nominal pembiayaan yang diajukan dan disesuaikan dengan kebijakan koperasi dan anggota berhak membatalkan pengajuan jikalau perubahan dari pengajuan awal tidak sesuai dengan harapan"</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>

<?= $this->section('content-script'); ?>
<script>
    // new AutoNumeric('.jumlah_pembiayaan', autoNumericOptions);
    var rupiah = document.getElementById('jumlah_pembiayaan');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
    $(window).on('load', function() {
        var anggota = $('#agt').val();
        if (anggota != '') {
            $.ajax({
                url: "<?= base_url('pembiayaan/fetch_anggota'); ?>",
                method: "POST",
                data: {
                    user_id: anggota,
                },
                dataType: 'json',
                success: function(data) {
                    $('#maks_pembiayaan').val(data.nominal);
                    console.log(data.nominal)
                }
            });
        } else {
            $('#maks_pembiayaan').val(0);
        }
    })

    $(document).ready(function() {


        $('#angsuran').on('keyup', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = 340000;
            var margin = 0.05;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
        });

        $('#angsuran').on('input', function() {
            var angsuran = $('#angsuran').val();
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var biaya_administrasi = 340000;
            var margin = 0.5;
            var angsuran_pokok = parseInt(jumlah_pembiayaan) / parseInt(angsuran);
            var nilai_margin = angsuran_pokok * margin;
            // var nilai_administrasi = biaya_administrasi / angsuran;
            var total_angsuran = Math.floor(angsuran_pokok + nilai_margin);
            var total_pembiayaan = Math.floor((total_angsuran * angsuran) + biaya_administrasi);
            $('#total_angsuran').val(formatNominal(total_angsuran));
            $('#total_pembiayaan').val(formatNominal(total_pembiayaan));
        });

        $('#jumlah_pembiayaan').on('input', function() {
            var jumlah_pembiayaan = $('#jumlah_pembiayaan').val().replaceAll(".", "");
            var maks_pembiayaan = $('#maks_pembiayaan').val();
            var total_pembiayaan = parseInt(maks_pembiayaan) * 100;

            if (parseInt(jumlah_pembiayaan) > total_pembiayaan) {
                event.preventDefault();
                swal(
                    'Gagal',
                    'Maaf pembiayaan lebih dari nominal biaya yang disyaratkan, Maksimal Pembiayaan ' + formatNominal(total_pembiayaan),
                    'error');
                $('#jumlah_pembiayaan').val('')
            }
        });

    });
</script>

<?= $this->endSection('content-script'); ?>