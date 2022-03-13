<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHealthCertificationRequest extends FormRequest
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
            'patient_id' => 'required', 
            'consulting_room_id' => 'required', 
            'user_id' => 'required', 
            'total_money' => 'required|numeric|min:0',
            'date' => 'required',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Ngày khám là trường bắt buộc.',
            'time.required' => 'Giờ khám là trường bắt buộc.',
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'title.max' => 'Tiêu đề không được dài quá :max ký tự.',
            'patient_id.required' => 'Tên bệnh nhân là trường bắt buộc.', 
            'consulting_room_id.required' => 'Phòng khám là trường bắt buộc.', 
            'user_id.required' => 'Bác sĩ là trường bắt buộc.', 
            'total_money.required' => 'Giá là trường bắt buộc.',
            'total_money.min' => 'Giá nhỏ nhất là :min VNĐ.',
        ];
    }
}
