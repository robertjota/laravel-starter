<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $permissionId = $this->route('permission')->id ?? null;
        
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permissionId)],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del permiso es requerido',
            'name.unique' => 'El nombre del permiso ya existe',
        ];
    }
}
