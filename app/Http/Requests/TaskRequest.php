<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'description' => 'required|string',
            'status' => 'required|in:in_progress,completed,pending',
            'parent_id' => 'nullable|exists:tasks,id',
            'image' => 'nullable|image|max:2048', // максимум 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название задачи обязательно',
            'name.max' => 'Название задачи не должно превышать 255 символов',
            'description.required' => 'Описание задачи обязательно',
            'status.required' => 'Статус задачи обязателен',
            'status.in' => 'Недопустимый статус задачи',
            'parent_id.exists' => 'Указанная родительская задача не существует',
            'image.image' => 'Файл должен быть изображением',
            'image.max' => 'Размер изображения не должен превышать 2MB',
        ];
    }
}
