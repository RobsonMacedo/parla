<?php

namespace App\Http\Requests;

class EditionStore extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required',
            'year' => 'required',
            'month' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value < 1 || $value > 12) {
                        $fail('O mês deve ser um valor entre 1 e 12.');
                    }
                }
            ]
        ];
    }

    /**
     * @param array $all
     * @return array
     */
    public function sanitize(array $all)
    {
        if (isset($all['month'])) {
            $all['month'] = (int) $all['month'];
        }

        if (isset($all['year'])) {
            $all['year'] = (int) $all['year'];
        }

        if (isset($all['number'])) {
            $all['number'] = (int) $all['number'];
        }

        return parent::sanitize($all);
    }
}
