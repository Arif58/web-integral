<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

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
        $rules = [
            'question_text' => 'required|string',
            'type' => 'required|in:pilihan_ganda,pilihan_ganda_majemuk,pernyataan,isian_singkat',
        ]; 

        if ($this->type === 'pernyataan') {
            $rules['answers'] = ['required', 'array', function ($attribute, $value, $fail) {
                if (in_array(null, $value, true)) {
                    $fail('Pernyataan tidak boleh ada yang kosong');
                }
            }];
            // $rules['answers.*'] = 'required|string';
            $rules['statements'] = ['required', 'array', function ($attribute, $value, $fail) {
                if (in_array(null, $value, true)) {
                    $fail('Jawaban benar tidak boleh ada yang kosong');
                }
            }];
            // $rules['statements.*'] = 'required|string';
        } else if($this->type === 'pilihan_ganda' || $this->type === 'pilihan_ganda_majemuk') {
            // $rules['answers'] = 'required|array|min:5';
            // $rules['answers.*'] = 'required|string';
            $rules['answers'] = ['required', 'array', function($attribute, $value, $fail) {
                if (in_array(null, $value, true)) {
                    $fail('Jawaban tidak boleh ada yang kosong');
                }
            }];
            $rules['is_correct.*'] = 'in:0,1';
            $rules['is_correct'] = ['required', 'array', function ($attribute, $value, $fail) {
                if (!in_array('1', $value, true)) {
                    $fail('Pilih minimal satu jawaban benar.');
                }
            }];
        } else if($this->type === 'isian_singkat') {
            $rules['answers'] = 'required';
        }
        return $rules;
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
