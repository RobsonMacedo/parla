<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

class UploadedFileStore extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['file' => 'required|max:20480|mimes:png,jpeg'];
    }
}
