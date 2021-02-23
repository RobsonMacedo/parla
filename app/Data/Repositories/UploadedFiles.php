<?php

namespace App\Data\Repositories;

use App\Models\UploadedFile as UploadedFileModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadedFiles extends Base
{
    /**
     * @var string
     */
    protected $model = UploadedFileModel::class;

    /**
     * @param $file
     * @param $uploadedFile
     * @return bool
     */
    protected function fileExists($file, $uploadedFile): bool
    {
        return Storage::disk($this->getDrive())->exists(
            $this->makePath($file->hash, $uploadedFile)
        );
    }

    private function findOrCreateFile($uploadedFile)
    {
        $hash = sha1(file_get_contents($uploadedFile->getPathName()));

        if (!($file = $this->findByHash($hash))) {
            $file = $this->new();

            $file->hash = $hash;

            $file->drive = $this->getDrive();

            $file->path = $this->makePath($hash, $uploadedFile);

            $file->mime_type = $uploadedFile->getClientMimeType();

            $file->original_name = $uploadedFile->getClientOriginalName();

            $file->save();
        }

        return $file;
    }

    private function makeDirectory($hash)
    {
        return make_deep_path($hash);
    }

    /**
     * @param $file
     * @param $uploadedFile
     */
    protected function storeFile($file, $uploadedFile): void
    {
        if (!$this->fileExists($file, $uploadedFile)) {
            $uploadedFile->storeAs(
                $this->makeDirectory($file->hash),
                $this->makeFileName($file->hash, $uploadedFile),
                $this->getDrive()
            );
        }
    }

    /**
     * @param $uploadedFile
     * @return File
     */
    public function storePhysicalFile($uploadedFile): UploadedFileModel
    {
        $this->storeFile(
            $file = $this->findOrCreateFile($uploadedFile),
            $uploadedFile
        );

        if (method_exists($this, 'fireEvents')) {
            $this->fireEvents($file);
        }

        return $file;
    }

    private function getDrive()
    {
        return config('filesystems.documents_default', 'documents');
    }

    /**
     * @param $hash
     * @param $uploadedFile
     * @return string
     */
    private function makeFileName($hash, $uploadedFile): string
    {
        return $hash .
            '.' .
            Str::lower($uploadedFile->getClientOriginalExtension());
    }

    /**
     * @param $hash
     * @param $uploadedFile
     * @return string
     */
    private function makePath($hash, $uploadedFile): string
    {
        $deep = $this->makeDirectory($hash);

        $filename = $this->makeFileName($hash, $uploadedFile);

        return "{$deep}{$filename}";
    }

    public function store($file)
    {
        $physicalFile = $this->storePhysicalFile($file);
        return $physicalFile;
    }
}
