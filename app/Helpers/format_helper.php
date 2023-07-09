
<?php
if (!function_exists('nominal')) {
    function nominal($angka)
    {
        $jd = number_format($angka, 0, '.', '.');
        return 'Rp ' . $jd;
    }
    function nominal_($angka)
    {
        $jd = number_format($angka, 0, '.', '.');
        return $jd;
    }
}

if (!function_exists('format_date')) {
    function format_date($date)
    {
        $waktu = date("d-m-Y", strtotime($date));;
        $result = $waktu;

        return $result;
    }
}

if (!function_exists('date_reverse')) {
    function date_reverse($date)
    {
        $waktu = date("Y-m-d", strtotime($date));;
        $result = $waktu;

        return $result;
    }
}

function replace_nominal($params)
{
    if ($params) {
        return str_replace('.', '', $params);
    }
}

function format_bulan($a)
{
    $a = str_pad($a, 2, "0", STR_PAD_LEFT);
    $bulanIndonesia = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    return $bulanIndonesia[$a];
}

?>

