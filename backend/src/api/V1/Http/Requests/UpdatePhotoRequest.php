<?php

namespace Api\V1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePhotoRequest.
 *
 * @package Api\V1\Http\Requests
 */
class UpdatePhotoRequest extends FormRequest
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
            'file' => [
                'required',
                'filled',
                'file',
                'image',
                'mimes:jpeg,png',
                sprintf('dimensions:min_width=%s,min_height=%s', config('main.upload.min-image-width'), config('main.upload.min-image-height')),
                sprintf('min:%s', config('main.upload.min-size')),
                sprintf('max:%s', config('main.upload.max-size')),
            ],
        ];
    }
}
