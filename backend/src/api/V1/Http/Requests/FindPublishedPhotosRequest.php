<?php

namespace Api\V1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FindPublishedPhotosRequest.
 *
 * @package Api\V1\Http\Requests
 */
class FindPublishedPhotosRequest extends FormRequest
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
            'page' => ['filled', 'integer', 'min:1'],
            'per_page' => ['filled', 'integer', 'min:1', 'max:100'],
            'query' => ['filled', 'string', 'min:1', 'max:255'],
            'tag' => ['filled', 'string', 'min:1', 'max:255'],
        ];
    }
}
