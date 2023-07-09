<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KOPERASI SIMPAN PINJAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
        table th {
            background: #0c1c60 !important;
            color: #fff !important;
            border: 1px solid #ddd !important;
            line-height: 15px !important;
            vertical-align: middle !important;
        }

        table td {
            border: 1px solid #ddd !important;
            line-height: 15px !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">

        <div class="pb-2">
            <div class="row">
                <div class="col-sm-12" style="background-color:white;" align="center">
                    <b>KOPERASI SIMPAN PINJAM</b>
                </div>
                <div class="col-sm-12" style="background-color:white;" align="center">
                    <b>LAPORAN PEMBIAYAAN</b>
                </div>
                <div class="col-sm-12" style="background-color:white;" align="center">
                    <b>Periode <?= $month ?> <?= $year ?></b>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover" style="padding-top: 20px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Anggota</th>
                    <th>Jumlah Pembiayaan</th>
                    <th>Total Pembiayaan</th>
                    <th>Angsuran ke</th>
                    <th>Jumlah Angsuran</th>
                    <th width="100">Sisa Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $saldo_pembiayaan = 0;
                foreach ($lap_pembiayaan as $data) :
                    $saldo_pembiayaan =  $data['total_pembiayaan'] -  ($data['angsuran_ke'] * $data['jumlah_angsuran']) ?>
                    <tr>
                        <th><?= $no++ ?></th>
                        <td><?= $data['full_name'] ?></td>
                        <td style="text-align: right;"><?= nominal($data['jumlah_pembiayaan']) ?></td>
                        <td style="text-align: right;"><?= nominal($data['total_pembiayaan']) ?> </td>
                        <td style="text-align: center;"><?= $data['angsuran_ke'] ?> </td>
                        <td style="text-align: right;"><?= nominal($data['jumlah_angsuran']) ?></td>
                        <td style="text-align: right;"><?= nominal($saldo_pembiayaan) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>