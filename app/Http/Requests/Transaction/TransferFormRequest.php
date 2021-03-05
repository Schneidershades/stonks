<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

/**
/**
 * @OA\Schema(
 *      title="Transfer Form Request Fields",
 *      description="Transfer request body data",
 *      type="object",
 *      required={"email"}
 * )
 */

class TransferFormRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Receiver email",
     *      description="Email of the receiver",
     *      example="info@hdp.com"
     * )
     *
     * @var string
     */
    private $receiver_email;

     /**
     * @OA\Property(
     *      title="Transaction Description",
     *      description="Description of the transaction ",
     *      example="pay back my loan"
     * )
     *
     * @var string
     */
    private $description;

     /**
     * @OA\Property(
     *      title="Transaction amount",
     *      description="Description of the transaction ",
     *      example="1000"
     * )
     *
     * @var int
     */
    private $amount;


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
     * @return array
     */
    public function rules()
    {
        return [
            'receiver_email' => 'required|string|exists:users,email',
            'description' => 'string',
            'amount' => 'required|numeric|min:0.1|max:100000000',
        ];
    }
}
