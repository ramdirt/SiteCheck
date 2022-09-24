<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user_id = Auth::user()->id;

        return [
            'name' => ['required'],
            'email' => ['required', 'email', "unique:users,email,{$user_id}"],
            'interval' => ['required'],
            'telegram_id' => ['numeric'],
            'report_telegram' => ['required'],
            'report_email' => ['required'],
            'enable_reports' => ['required'],
        ];
    }
}