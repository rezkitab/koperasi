<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function slug($s)
{
    $c = array(' ');
    $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
function dead($data)
{
    echo '<pre class="-debug">';
    print_r($data);
    echo '</pre>' . "\n";
    die();
}
