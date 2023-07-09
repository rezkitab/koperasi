<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Pembayaran</title>
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            border-collapse: collapse;
        }

        thead>tr {
            background-color: #0070C0;
            color: #f1f1f1;
        }

        thead>tr>th {
            background-color: #0070C0;
            color: #fff;
            padding: 10px;
            border-color: #fff;
        }

        th,
        td {
            padding: 2px;
        }

        th {
            color: #222;
        }

        body {
            font-family: Calibri;
        }
    </style>
</head>

<body onload="window.print();">

    <h4 align="center" style="margin-top:0px;"><u>KOPERASI SIMPAN PINJAM
LAPORAN SIMPANAN MANASUKA</u></h4>
    <b>

    </b>
    <br>
    <h2>Simpanan Wajib</h2>
    <table class="table table-striped " id="basic-1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nama Bank</th>
                <th>No Rekening</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Tanggal Penarikan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($simpanan_manasuka as $a) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $a->full_name ?></td>
                    <td><?= $a->nama_bank ?></td>
                    <td><?= $a->no_rekening ?></td>
                    <td>Rp. <?= number_format($a->nominal, 0, ",", ".")  ?></td>
                    <td><?php if ($a->status == 200) { ?>
                            Berhasil
                        <?php } elseif ($a->status == 201) { ?>
                            Pending
                        <?php } else { ?>

                            Gagal
                        <?php } ?></td>
                    <td><?= $a->tgl_penarikan ?></td>


                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>