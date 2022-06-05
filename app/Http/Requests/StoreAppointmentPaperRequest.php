<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentPaperRequest extends FormRequest
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
            'title' => 'required|max:255',
            'date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Ngày hẹn khám bệnh là trường bắt buộc.',
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'title.max' => 'Tiêu đề không được dài quá :max ký tự.',
        ];
    }
}
