<?php

namespace Config;

use CodeIgniter\Debug\Toolbar\Collectors\Routes;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('auth', 'Auth::index');
$routes->get('auth/login', 'Auth::login');


$routes->group('/', ['filter' => 'auth'], function ($routes) {

    /*
    * --------------------------------------------------------------------
    * Syair Lingga Update Routing
    * --------------------------------------------------------------------
    *
    * There will often be times that you need Syair Lingga Update routing and you
    * need it to be able to override any defaults in this file. Environment
    * based routes is one such time. require() Syair Lingga Update route files here
    * to make that happen.
    *
    * You will have access to the $routes object within that file without
    * needing to reload it.
    */

    //Master Data Chart of Account (COA)
    $routes->get('/master-coa', 'Master\CoaController::index');
    $routes->get('/coa', 'Master\CoaController::get_data');
    $routes->get('/coa/subhead', 'Master\CoaController::get_coa_subhead');
    $routes->get('/coa/activity', 'Master\CoaController::get_coa_activity');
    $routes->get('/coa/find', 'Master\CoaController::show');
    $routes->post('/coa', 'Master\CoaController::store');
    $routes->put('/coa', 'Master\CoaController::update');

    //Master Data Kategori Pengeluaran
    $routes->get('master-kategori-pengeluaran', 'Master\KategoriPengeluaranController::index');
    $routes->get('kategori-pengeluaran', 'Master\KategoriPengeluaranController::get_data');
    $routes->get('kategori-pengeluaran/opsi', 'Master\KategoriPengeluaranController::filterOption');
    $routes->get('kategori-pengeluaran/find', 'Master\KategoriPengeluaranController::show');
    $routes->get('kategori-pengeluaran/akun', 'Master\KategoriPengeluaranController::getAkun');
    $routes->post('kategori-pengeluaran', 'Master\KategoriPengeluaranController::store');
    $routes->put('kategori-pengeluaran', 'Master\KategoriPengeluaranController::update');


    //Transaksi Pengeluaran Kas
    $routes->get('/transaksi-pengeluaran', 'Transaksi\PengeluaranController::index');

    $routes->get('/pengeluaran', 'Transaksi\PengeluaranController::getData');
    $routes->get('/pengeluaran/find', 'Transaksi\PengeluaranController::show');
    $routes->post('/pengeluaran', 'Transaksi\PengeluaranController::store');
    $routes->put('/pengeluaran', 'Transaksi\PengeluaranController::update');

    //Laporan Jurnal Umum
    $routes->get('/laporan-jurnal-umum', 'Laporan\JurnalUmumController::index');
    $routes->get('/jurnal-umum', 'Laporan\JurnalUmumController::getData');
    $routes->post('/jurnal-umum', 'Laporan\JurnalUmumController::getData');

    //Laporan Buku Besar
    $routes->get('/laporan-buku-besar', 'Laporan\BukuBesarController::index');
    $routes->get('/buku-besar/coa', 'Laporan\BukuBesarController::filterOption');
    $routes->post('/buku-besar', 'Laporan\BukuBesarController::getData');

    //Laporan Laba Rugi
    $routes->get('/laporan-laba-rugi', 'Laporan\LabaRugiController::index');
    $routes->get('/laba-rugi', 'Laporan\LabaRugiController::getData');
    $routes->post('/laba-rugi', 'Laporan\LabaRugiController::getData');

    //Laporan Arus Kas
    $routes->get('/laporan-arus-kas', 'Laporan\ArusKasController::index');
    $routes->get('/arus-kas', 'Laporan\ArusKasController::getData');
    $routes->post('/arus-kas', 'Laporan\ArusKasController::getData');

    //Neraca Saldo
    $routes->get('/laporan-neraca-saldo', 'Laporan\NeracaSaldoController::index');
    $routes->get('/neraca-saldo', 'Laporan\NeracaSaldoController::getData');
    $routes->post('/neraca-saldo', 'Laporan\NeracaSaldoController::getData');

    /*
    * --------------------------------------------------------------------
    * Syair Lingga Update Routing End
    * --------------------------------------------------------------------
    */


    $routes->get('user', 'User::index');
    $routes->get('user/(:segment)/edit', 'User::edit/$1');
    $routes->patch('user/(:segment)', 'User::update/$1');
    $routes->delete('user/(:segment)', 'User::delete/$1');
    $routes->patch('user/(:segment)/changestatus', 'User::changeStatus/$1');

    $routes->get('setting/aplikasi', 'Setting::aplikasi');
    // $routes->get('setting/aplikasi', 'Setting::index');



    // PENGURUS
    $routes->get('/pengurus', 'Pengurus::index');
    $routes->get('/pengurus/add', 'Pengurus::add');
    $routes->post('/pengurus/create', 'Pengurus::create');
    $routes->get('/pengurus/edit/(:any)', 'Pengurus::edit/$1');
    $routes->post('/pengurus/update/(:any)', 'Pengurus::update/$1');
    $routes->post('/pengurus/delete', 'Pengurus::delete');

    // PEMBIAYAAN
    $routes->get('pembiayaan', 'Pembiayaan::index');
    $routes->get('pembiayaan/add', 'Pembiayaan::add');
    $routes->post('/piutang/update', 'Piutang::update');
    $routes->get('/pembiayaan/detail/(:any)', 'Pembiayaan::detail/$1');
    $routes->get('/pembiayaan/detail_pengajuan/(:any)', 'Pembiayaan::detail_pengajuan/$1');
    $routes->get('/pembiayaan/print-angsuran/(:any)', 'Pembiayaan::print_angsuran/$1');
    $routes->post('pembiayaan/fetch_anggota', 'Pembiayaan::fetch_anggota');
    $routes->post('pembiayaan/update_status', 'Pembiayaan::update_status');
    $routes->post('pembiayaan/update_pengajuan', 'Pembiayaan::update_pengajuan');
    $routes->get('/pembiayaan/payment', 'Pembiayaan::payment');
    $routes->get('/pembiayaan/payment', 'Pembiayaan::payment');
    $routes->post('/pembiayaan/finishPayment', 'Pembiayaan::finishPayment');
    $routes->get('/pembiayaan/payment_anggota', 'Pembiayaan::payment_anggota');
    $routes->post('/pembiayaan/payment_anggota', 'Pembiayaan::payment_anggota');
    $routes->post('/pembiayaan/finishPayment_anggota', 'Pembiayaan::finishPayment_anggota');
    $routes->post('pembiayaan/setujui', 'Pembiayaan::setujui');
    $routes->post('pembiayaan/tolak', 'Pembiayaan::tolak');
    $routes->post('pembiayaan/setujui_anggota', 'Pembiayaan::setujui_anggota');
    $routes->post('pembiayaan/tolak_anggota', 'Pembiayaan::tolak_anggota');

    // <!-- PEMBIAYAAN ANGGOTA ---!> 
    $routes->get('pembiayaan/anggota', 'Pembiayaan::anggota');
    $routes->get('/pembiayaan/anggota/detail/(:any)', 'Pembiayaan::anggota_detail/$1');
    $routes->get('/pembiayaan/anggota_add', 'Pembiayaan::anggota_add');

    //LAPORAN PEMBIAYAAN
    $routes->get('/laporan-pembiayaan', 'LaporanPembiayaan::index');
    $routes->get('/laporan-pembiayaan/index', 'LaporanPembiayaan::index');
    $routes->post('/laporan-pembiayaan/(:any)', 'LaporanPembiayaan::show_data_laporan_pembiayaan');
    $routes->get('/laporan-pembiayaan/pdf', 'LaporanPembiayaan::laporan_pembiayaan_pdf');

    // LAPOARAN SIMPANAN POKOK
    $routes->get('/laporan/simpanan_pokok', 'LaporanController::simpanan_pokok');
    $routes->get('/laporan/simpanan_wajib', 'LaporanController::simpanan_wajib');
    $routes->get('/laporan/simpanan_manasuka', 'LaporanController::simpanan_manasuka');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
