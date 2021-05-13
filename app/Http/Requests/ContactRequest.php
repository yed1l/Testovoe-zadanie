<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'topic' => 'required|min:5|max:50',
            'message' => 'required|min:20|max:300',
            'file' => 'required|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'topic.required' => 'Поле темы обращения является обязательным',
            'topic.min' => 'Поле темы обращения должно быть длинее 5 символов',
            'topic.max' => 'Поле темы обращения должно быть не более 50 символов',
            'message.required' => 'Поле сообщения является обязательным',
            'message.min' => 'Поле сообщения должно быть длинее 20 символов',
            'message.max' => 'Поле сообщения должно быть не более 300 символов',
            'file.required' => 'Обязательно нужно прикрепить файл'
        ];
    }
}
