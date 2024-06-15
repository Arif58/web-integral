<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
    public function rules()
    {
         return [
            'question_text' => 'required|string',
            'type' => 'required|in:pilihan_ganda,pilihan_ganda_majemuk,pernyataan,isian_singkat',
        ];

        if ($this->type === 'pernyataan') {
            $rules['statement'] = 'required|array|min:1';
            $rules['statement.*'] = 'required|string';
        } else if($this->type === 'pilihan_ganda' || $this->type === 'pilihan_ganda_majemuk') {
            $rules['answers'] = 'required|array|min:1';
            $rules['answers.*'] = 'required|string';
            $rules['is_correct'] = 'required|array';
            $rules['is_correct.*'] = 'required|boolean';
        } else if($this->type === 'isian_singkat') {
            $rules['answers'] = 'required';
        }
    }

    public function messages()
    {
        return [
            'question_text.required' => 'Soal wajib diisi.',
            'type.required' => 'Tipe soal wajib dipilih.',
            'type.in' => 'Tipe soal yang dipilih tidak valid.',
            'answers.required' => 'Jawaban wajib diisi.',
            'answers.array' => 'Jawaban harus berupa array.',
            'answers.*.required' => 'Setiap jawaban wajib diisi.',
            'is_correct.required' => 'Status jawaban benar wajib diisi.',
            'is_correct.array' => 'Status jawaban benar harus berupa array.',
            'is_correct.*.boolean' => 'Status jawaban benar harus berupa boolean.',
            'statements.required' => 'Pernyataan wajib diisi untuk tipe soal pernyataan.',
            'statements.array' => 'Pernyataan harus berupa array.',
            'statements.*.required' => 'Setiap pernyataan wajib diisi.',
        ];
    }
}
