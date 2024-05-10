<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            [
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
                'name' => 'required|string',
                'weight' => 'required|integer',
                'price' => 'required|integer',
                'stock' => 'required|integer',
                'condition' => 'required|in:Baru,Bekas',
                'description' => 'required|max:2000', // maksimal 2000 karakter
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'image.required' => 'Kolom gambar harus diisi.',
            'image.image' => 'Kolom gambar harus berupa gambar.',
            'image.mimes' => 'Kolom gambar harus memiliki format jpg, jpeg, atau png.',
            'image.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
            'name.required' => 'Kolom nama harus diisi.',
            'weight.required' => 'Kolom berat harus diisi.',
            'weight.integer' => 'Kolom berat harus berupa angka.',
            'price.required' => 'Kolom harga harus diisi.',
            'price.integer' => 'Kolom harga harus berupa angka.',
            'stock.required' => 'Kolom stok harus diisi.',
            'stock.integer' => 'Kolom stok harus berupa angka.',
            'condition.required' => 'Kolom kondisi harus diisi.',
            'condition.in' => 'Kolom kondisi harus diisi dengan nilai Baru atau Bekas.',
            'description.required' => 'Kolom deskripsi harus diisi.',
            'description.max' => 'Deskripsi tidak boleh melebihi 2000 karakter.',
        ];
    }
}
