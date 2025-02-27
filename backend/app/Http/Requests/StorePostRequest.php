<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="PostRequest",
 *     required={"title", "content"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         minLength=5,
 *         maxLength=255,
 *         example="Título del post"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         minLength=10,
 *         example="Contenido detallado del post..."
 *     )
 * )
 */
class StorePostRequest extends FormRequest
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
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status'  => ['required', 'string', 'in:1,0'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
