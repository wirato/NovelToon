<?php
use App\Novel;
use App\Manga;
use Illuminate\Support\Facades\Input;

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

Route::get('/', 'ReadController@shownovels');

Route::resource('mangas', 'MangaController');
Route::get('mangasadmin', 'MangaController@mangas')->name('mangasadmin');
Route::get('mangasadmin/{id}', 'MangaController@manga')->name('mangaDetails');
Route::get('mangasadmin/{id}/edit', 'MangaController@edit')->name('editmanga');
Route::get('mangadetails/episode/{id}', 'MangaController@readManga')->name('readManga');
Route::get('mangaDetail/episode/{id}', 'MangaEpisodeController@readMangaEp')->name('readMangaEp');
Route::get('mangaDetail/{id}', 'MangaEpisodeController@mangaDetail')->name('mangaDetail');
Route::get('mangasall', 'MangaEpisodeController@mangas')->name('mangasall');

Route::get('mangasadmin/{id}/addEP', 'MangaEpisodeController@addMangaEp')->name('addMangaEp');
Route::resource('createMangaEpisode', 'MangaEpisodeController');

Route::post('MangaEP/', 'MangaEPController@store')->name('MangaEPs');

Route::post('save', 'MangaEpisodeController@save');

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');

Route::resource('novels', 'NovelController');

Route::get('edit/{id}', 'NovelController@edit')->name('edit');

Route::get('mynovels', 'NovelController@mynovels')->name('mynovels');
Route::get('mynovel/{id}', 'NovelController@mynovel')->name('mynovel');

Route::get('mynovelep/{id}', 'NovelController@mynovelep')->name('mynovelep');

Route::resource('episodes', 'EpisodeController');
Route::get('mynovel/{id}/addepisode', 'EpisodeController@mynovelep')->name('novelep');
Route::get('editEp/{id}', 'EpisodeController@edit')->name('editEp');

Route::get('noveldetails/{id}', 'ReadController@noveldetails')->name('noveldetails');
Route::get('noveldetails/episode/{id}', 'ReadController@readEp')->name('readEp');
Route::get('allnovels', 'ReadController@allnovels')->name('allnovels');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/searchs', function () {
    return view('search');
});

Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $novels = Novel::where('title','LIKE','%'.$q.'%')->get();
    $mangas = Manga::where('title','LIKE','%'.$q.'%')->get();

    if(count($novels) > 0 || count($mangas) > 0)
        return view('search', compact('novels','mangas','q'));
    else return view ('search')->withMessage('No Details found. Try to search again !')->withQuery ( $q );
});
