<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        KOPERASI SIMPAN PINJAM
        LAPORAN SIMPANAN POKOK
    </title>
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            LAPORAN SIMPANAN POKOK</u></h4>
    <b>

    </b>
    <br>
    <h2>Simpanan Pokok</h2>
    <table class="table table-striped " id="basic-1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($simpanan_pokok as $a) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $a->full_name ?></td>
                    <td><?= $a->tgl_bayar ?></td>
                    <td><?php if ($a->status == 1) { ?>
                            Berhasil
                        <?php } elseif ($a->status == 2) { ?>
                            Pending
                        <?php } else { ?>

                            Verifikasi Admin
                        <?php } ?></td>


                    <td>Rp. <?= number_format($a->nominal, 0, ",", ".")  ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total: </td>
                <td id="total">Rp. <?= number_format($total->total, 0, ",", ".")  ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>