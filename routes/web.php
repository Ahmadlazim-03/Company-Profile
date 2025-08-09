<?php

use App\Models\News;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use \App\Http\Controllers\InfoController;

// Route::get('/', function () {
//     return view('portal.index');
// });
Route::get('/', function () {
    return view('compro');
});

Route::get('/news', function () {
    $latestNews = News::with('department')->latest()->first();
    $news_data = News::with('department')->latest()->paginate(5);
    return view('news.index', compact( 'latestNews','news_data'));
});


Route::get('/news/detail/{id}', function ($id) {
    $news = NewsController::getNewsById($id);
    if (!$news) {
        return redirect('/news')->with('error', 'Berita tidak ditemukan.');
    }
    $newsList = NewsController::getNewsWithPagination();
    return view('news.show', compact('news', 'newsList'));
});

Route::get('/about', function () {
    return view('about-us');
});

Route::get('/department/ekonomi-kreatif', function () {
    return view('depart.ekraf');
});

Route::get('/portal', function () {
    $infoList = InfoController::index();
    return view('portal.index', compact('infoList'));
});

Route::get('/portal/detail/{id}', function ($id) {
    $info = InfoController::getInfoById($id);
    if (!$info) {
        return redirect('/portal')->with('error', 'Informasi tidak ditemukan.');
    }
    $infoList = array_slice(InfoController::getLatestInfo(4), 1, 3);
    return view('portal.show', compact('info', 'infoList'));
});

// Route::get('/sop/{any?}', function () {
//     return view('coming-soon');
// })->where('any', '.*');

Route::get('/sop/partnership', function () {
    return view('partnership');
});

Route::get('/sop/medinfo', function () {
    return view('medinfo');
});

Route::get('/features/{any?}', function () {
    return view('coming-soon');
})->where('any', '.*');

Route::get('/department/{any}', function ($any) {
    // Only ekonomi-kreatif department is built, others redirect to coming soon
    if ($any !== 'ekonomi-kreatif') {
        return view('coming-soon');
    }
    return view('depart');
})->where('any', '.*');

Route::get('/contact', function () {
    return view('coming-soon');
});

Route::get('/events', function () {
    return view('coming-soon');
});

Route::get('/gallery', function () {
    return view('coming-soon');
});

Route::get('/marketplace', function () {
    return view('marketplace.index');
});
Route::get('/marketplace/baju-himti', function () {
    return view('marketplace.detail');
});



// Catch-all route for any undefined routes
Route::fallback(function () {
    return view('coming-soon');
});
