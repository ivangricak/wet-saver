<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group_id' => 'nullable|integer|exists:groups,id|required_without:default_group_id',
            'default_group_id' => 'nullable|integer|exists:default_groups,id|required_without:group_id',

            'name' => 'string|required',
            'description' => 'string|nullable',
            'link' => 'string|required',
            'state' => 'integer|nullable',

            'tags' => 'array|nullable',          // масив id тегів
            'tags.*' => 'integer|exists:tags,id' // перевірка кожного id
        ];
    }
}
