<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'name' => 'required|max:255|regex:/^[A-Za-z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễếệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/',
            'phone' => 'required|size:10',
            'content' => 'required|max:255',
            'email' => [
                'required', 'max:255', 'string', 'email',
            ],
            'date' => 'required',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Ngày khám là trường bắt buộc.',
            'time.required' => 'Giờ khám là trường bắt buộc.',
            'name.required' => 'Họ và tên là trường bắt buộc.', 
            'name.max' => 'Họ và tên không được dài quá :max ký tự.', 
            'name.regex' => 'Họ và tên không được chứa ký tự đặc biệt.', 
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.size' => 'Số điện thoại phải là :size số.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'content.required' => 'Triệu chứng hoặc yêu cầu khám là trường bắt buộc.', 
            'content.max' => 'Triệu chứng hoặc yêu cầu khám không được dài quá :max ký tự.', 
        ];
    }
}
