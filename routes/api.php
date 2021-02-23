<?php

use Illuminate\Http\Request;
use App\Data\Repositories\Photos as PhotosRepository;
use App\Data\Repositories\Articles as ArticlesRepository;
use App\Data\Repositories\Editorial as EditorialRepository;
use App\Http\Controllers\Admin\Articles as AdminArticles;
use App\Http\Controllers\Admin\UploadedFiles as AdminUploadedFiles;

Route::group(['prefix' => '/editions'], function () {
    Route::get('/', function () {
        return app(ArticlesRepository::class)->editions(request()->get('allowUnpublished'));
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/', [AdminArticles::class, 'store'])->name('articles.store');

        Route::post('/{id}', [AdminArticles::class, 'update'])->name('articles.update');

        Route::get('/{id}/publish', function ($edition_id) {
            return app(ArticlesRepository::class)->publishEdition($edition_id, true);
        });

        Route::get('/{id}/unpublish', function ($edition_id) {
            return app(ArticlesRepository::class)->publishEdition($edition_id, false);
        });
    });
});

Route::group(['prefix' => '/posts/{edition_id}'], function () {
    Route::get('/featured', function ($edition_id) {
        return app(ArticlesRepository::class)->featured($edition_id);
    });

    Route::get('/nonFeatured', function ($edition_id) {
        return app(ArticlesRepository::class)->nonFeatured($edition_id);
    });

    Route::get('/published', function ($edition_id) {
        return app(ArticlesRepository::class)->all($edition_id);
    });

    Route::get('/all', function ($edition_id) {
        return app(ArticlesRepository::class)->all($edition_id, false);
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/{id}/publish', function ($edition_id, $article_id) {
            return app(ArticlesRepository::class)->publish($article_id, true);
        });

        Route::get('/{id}/unpublish', function ($edition_id, $article_id) {
            return app(ArticlesRepository::class)->publish($article_id, false);
        });
    });
});

Route::get('/posts/{slug}', function ($slug) {
    return Response::json(app(ArticlesRepository::class)->findBySlug($slug));
});

Route::post('/markdown/to/html', function (Request $request) {
    return [
        'lead' => ($markdown = $request->get('lead')),
        'body' => ($markdown = $request->get('body')),
        'lead_html' => app(App\Services\Markdown\Service::class)->convert($request->get('lead')),
        'body_html' => app(App\Services\Markdown\Service::class)->convert($request->get('body')),
    ];
});

Route::group(['prefix' => '/posts'], function () {
    Route::post('/', function (Request $request) {
        info('posting');
        return app(ArticlesRepository::class)->createOrUpdate($request->get('article'));
    });

    Route::get('/{post_id}/move-up', function (Request $request, $post_id) {
        return app(ArticlesRepository::class)->moveUp($post_id);
    });

    Route::get('/{post_id}/move-down', function (Request $request, $post_id) {
        return app(ArticlesRepository::class)->moveDown($post_id);
    });
});

Route::group(['prefix' => '/photos'], function () {
    Route::post('/', function (Request $request) {
        return app(PhotosRepository::class)->create($request->all());
    });

    Route::post('/{id}', function ($photo_id, Request $request) {
        return app(PhotosRepository::class)->update($photo_id, $request->all());
    });

    Route::get('/{id}/setMain', function ($photo_id) {
        return app(PhotosRepository::class)->setMain($photo_id, true);
    });

    Route::get('/{id}/unsetMain', function ($photo_id) {
        return app(PhotosRepository::class)->setMain($photo_id, false);
    });
});

Route::group(['prefix' => '/editorial'], function () {
    Route::get('/', function () {
        return app(EditorialRepository::class)->get();
    });

    Route::post('/', function (Request $request) {
        return app(EditorialRepository::class)->post($request->all());
    });
});

Route::group(['prefix' => '/uploaded-files'], function () {
    Route::get('/', [AdminUploadedFiles::class, 'all'])->name('uploaded-files.all');

    Route::post('/{id}', [AdminUploadedFiles::class, 'update'])->name('uploaded-files.update');

    Route::post('/', [AdminUploadedFiles::class, 'store'])->name('uploaded-files.store');
});
