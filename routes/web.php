<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sentimen\ClusteringController;
use App\Http\Controllers\Sentimen\KNNController;
use App\Http\Controllers\Sentimen\PreprocessingController;
use App\Http\Controllers\Sentimen\SmoteKNNController;
use App\Http\Controllers\Sentimen\UploadFileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/dashboard');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// Upload File
Route::get('/upload-file', [UploadFileController::class, 'index'])->name('upload-file');
Route::post('/upload-file/import', [UploadFileController::class, 'import'])->name('import-file');
Route::get('/reset-raw-data', [UploadFileController::class, 'reset_raw_data'])->name('reset-raw-data');

// Preprocessing
Route::get('/preprocessing', [PreprocessingController::class, 'index'])->name('preprocessing');
Route::get('/preprocessing/start', [PreprocessingController::class, 'start_preprocessing'])->name('preprocessing-start');
Route::get('/reset-preprocessing', [PreprocessingController::class, 'reset_preprocessing'])->name('reset-preprocessing');

// Clustering
Route::get('/clustering', [ClusteringController::class, 'index'])->name('clustering');
Route::get('/clustering/start', [ClusteringController::class, 'cluster'])->name('clustering-start');
Route::get('/reset-clustering', [ClusteringController::class, 'reset_clustering'])->name('reset-clustering');

// KNN
Route::get('/knn', [KNNController::class, 'index'])->name('knn');
Route::get('/knn/start', [KNNController::class, 'start_knn'])->name('knn-start');
Route::get('/reset-knn', [KNNController::class, 'reset_knn'])->name('reset-knn');

// KNN
Route::get('/smote-knn', [SmoteKNNController::class, 'index'])->name('smote-knn');
Route::get('/smote-knn/start', [SmoteKNNController::class, 'smote_knn_start'])->name('smote-knn-start');
Route::get('/reset-smote-knn', [SmoteKNNController::class, 'reset_smote_knn'])->name('reset-smote-knn');