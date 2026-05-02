// Contoh di routes/api.php
Route::get('/wilayah/provinsi', [WilayahController::class, 'getProvinsi']);
Route::get('/wilayah/kabupaten/{id_provinsi}', [WilayahController::class, 'getKabupaten']);
Route::get('/wilayah/kecamatan/{id_kabupaten}', [WilayahController::class, 'getKecamatan']);
Route::get('/wilayah/desa/{id_kecamatan}', [WilayahController::class, 'getDesa']);