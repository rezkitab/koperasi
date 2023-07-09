<?php

use Config\MyConfig;
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?= base_url() ?>/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.png" type="image/x-icon">
    <title>KOPERASI SIMPAN PINJAM</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/datatables.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/bootstrap.css">
    <!-- App css-->
    <link href="<?= base_url('assets/select2/css/select2.min.css') ?>" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?= base_url() ?>/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/date-picker.css">

    <style>
        @media print {

            .main-nav,
            .no-print,
            .sticky-footer {
                display: none;
                visibility: hidden;
            }

            .page-main-header {
                display: none;
                visibility: hidden;
            }

        }
    </style>

</head>

<body>
    <?= $this->include('layout/topbar'); ?>
    <!-- Loader starts-->
    <!-- <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div> -->

    <?= $this->include('layout/sidebar'); ?>

    <?= $this->renderSection('content'); ?>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->

    <!-- Page Header Ends -->


    <!-- Page Body Start-->

    <!-- footer start-->
    <?= $this->include('layout/footer'); ?>
    </div>
    </div>
    <!-- latest jquery-->
    <script src="<?= base_url() ?>/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="<?= base_url() ?>/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?= base_url() ?>/assets/js/sidebar-menu.js"></script>
    <script src="<?= base_url() ?>/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="<?= base_url() ?>/assets/js/chart/chartist/chartist.js"></script>
    <script src="<?= base_url() ?>/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="<?= base_url() ?>/assets/js/chart/knob/knob.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/chart/knob/knob-chart.js"></script>
    <script src="<?= base_url() ?>/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="<?= base_url() ?>/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="<?= base_url() ?>/assets/js/prism/prism.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/clipboard/clipboard.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/counter/counter-custom.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom-card/custom-card.js"></script>
    <script src="<?= base_url() ?>/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-au-mill.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-in-mill.js"></script>
    <script src="<?= base_url() ?>/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js"></script>
    <script src="<?= base_url() ?>/assets/js/dashboard/default.js"></script>

    <script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>

    <script src="<?= base_url() ?>/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?= base_url() ?>/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?= base_url() ?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="<?= base_url() ?>/assets/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/select2/select2.full.min.js"></script>

    <script src="<?= base_url() ?>/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?= base_url() ?>/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?= base_url() ?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->

    <!-- Theme js-->
    <script src="<?= base_url() ?>/assets/js/script.js"></script>
    <script src="<?= base_url() ?>/assets/js/theme-customizer/customizer.js"></script>
    <script src="<?= base_url() ?>/assets/currency.js"></script>
    <script src="<?= base_url('assets/js/number.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        <?php if (session()->getFlashdata('success')) { ?>
            swal(
                'success',
                '<?= session()->getFlashdata('success') ?>',
                'success');
        <?php } else if (session()->getFlashdata('error')) {  ?>
            swal(
                'error',
                '<?= session()->getFlashdata('error') ?>',
                'error');

        <?php } else if (session()->getFlashdata('warning')) {  ?>
            swal(
                'warning',
                '<?= session()->getFlashdata('warning') ?>',
                'warning');

        <?php } else if (session()->getFlashdata('info')) {  ?>
            swal(
                'info',
                '<?= session()->getFlashdata('info') ?>',
                'info');
        <?php } ?>
    </script>

    <script>
        const resetFormTambah = () => {
            $('#form-tambah').validate().resetForm();
            $('#form-tambah').trigger("reset");
            $("#table-detail tbody").empty();
        }
    </script>

    <?= $this->renderSection('content-script'); ?>
    <?= $this->renderSection('custom-js'); ?>



    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>