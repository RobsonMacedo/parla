<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Articles as ArticlesRepository;
use App\Http\Requests\EditionUpdate;
use App\Http\Requests\EditionStore;

class Articles extends Controller
{
    public function update(EditionUpdate $request, $id)
    {
        return app(ArticlesRepository::class)->updateEdition(
            $id,
            $request->all()
        );
    }

    public function store(EditionStore $request)
    {
        return app(ArticlesRepository::class)->createNewEdition(
            $request->all()
        );
    }
}
