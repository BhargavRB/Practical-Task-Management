<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in-progress,completed',
            'priority' => 'required|in:low,medium,high',
        ];
    }
}