<?php

namespace App\Http\Requests\User;

use App\Services\User\Data\RegisterUserData;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Don`t forget to switch to false when auth will complete
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'login' => 'required|unique:users,login',
//            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'required|min:8|confirmed',
        ];
    }


    public function data(): RegisterUserData
    {
        return  RegisterUserData::from($this->validated());
    }
}
