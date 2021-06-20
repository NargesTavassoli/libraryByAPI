<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class updateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = jdate(time())->getYear();
        if (\Auth::user()->is_admin == 1) {
            return [
                'file' => 'mimes:jpg,jpeg,png,gif|max:10240',
                'title' => 'string|min:1',
                'author' => 'string|min:1',
                'publisher' => 'string|min:1',
                'year' => "int|min:1200|max:$max",
                'price' => 'int|min:0',
                'stock' => 'int|min:0',
            ];
        } else {
            return [
                'file' => 'mimes:jpg,jpeg,png,gif|max:10240',
                'title' => 'string|min:1',
                'author' => 'string|min:1',
                'publisher' => 'string|min:1',
                'year' => "int|min:1200|max:$max",
                'price' => 'int|min:0',
            ];
        }
    }
}
