<?php

namespace App\Http\Requests\Tasks\Hints;

use Illuminate\Foundation\Http\FormRequest;

class HintRequest extends FormRequest
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
            "content" => 'required|filled',
            "subtracted_points" => 'required|filled|integer',
            "task_id" => 'required|filled|exists:tasks,id'
        ];
    }
}
