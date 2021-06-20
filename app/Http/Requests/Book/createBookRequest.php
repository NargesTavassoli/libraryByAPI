<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class createBookRequest extends FormRequest
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
                'title' => 'required|string|min:1',
                'author' => 'required|string|min:1',
                'publisher' => 'required|string|min:1',
                'year' => "required|int|min:1200|max:$max",
                'price' => 'required|int|min:0',
                'stock' => 'required|int|min:0'
            ];
        } else {
            return [
                'file' => 'mimes:jpg,jpeg,png,gif|max:10240',
                'title' => 'required|string|min:1',
                'author' => 'required|string|min:1',
                'publisher' => 'required|string|min:1',
                'year' => "required|int|min:1200|max:$max",
                'price' => 'required|int|min:0',
            ];
        }
    }
}
