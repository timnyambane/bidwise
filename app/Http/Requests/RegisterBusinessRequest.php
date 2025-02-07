<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RegisterBusinessRequest extends FormRequest
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
            'business_name' => ['required', 'string', 'max:255', 'unique:businesses,name'],
            'location' => ['required', 'array'],
            'location.id' => [
                'required',
                Rule::exists('locations', 'id')
            ],
            'work_category' => [
                'required',
            ],
            'work_category.id' => [
                Rule::exists('work_categories', 'id')
            ],
            'services' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    if (empty($this->work_category)) {
                        $fail('The work category must be selected first.');
                        return;
                    }

                    foreach ($value as $service) {
                        $exists = DB::table('services')
                            ->where('id', $service)
                            ->where('work_category_id', $this->work_category)
                            ->exists();

                        if (!$exists) {
                            $fail("Service ID {$service} is invalid or does not belong to the selected work category.");
                        }
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'location.array' => 'The selected location is invalid'
        ];
    }
}
