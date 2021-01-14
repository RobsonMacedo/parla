<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Data\Repositories\UploadedFiles as UploadedFilesRepository;
use App\Http\Requests\UploadedFileStore;
use App\Http\Requests\UploadedFileUpdate;
use Illuminate\Http\Request;

class UploadedFiles extends Controller
{
    /**
     * Get all data
     *
     * @return array
     */
    public function all(Request $request)
    {
        return app(UploadedFilesRepository::class)->all();
    }

    /**
     * @param UploadedFileUpdate $request
     * @param $id
     * @return mixed
     */
    public function update(UploadedFileUpdate $request, $id)
    {
        return app(UploadedFilesRepository::class)->update(
            $id,
            $request->all()
        );
    }

    /**
     * Store
     *
     * @param \App\Http\Requests\EntryDocumentStore $request
     * @param $congressmanId
     * @param $congressmanBudgetId
     * @param $entryId
     * @return mixed
     */
    public function store(UploadedFileStore $request)
    {
        return app(UploadedFilesRepository::class)->store(
            $request->all()['file']
        );
    }
}
