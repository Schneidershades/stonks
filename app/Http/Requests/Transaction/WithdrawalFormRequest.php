<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
/**
/**
 * @OA\Schema(
 *      title="Withdrawal Form Request Fields",
 *      description="Withdrawal request body data",
 *      type="object",
 *      required={"email"}
 * )
 */
class WithdrawalFormRequest extends FormRequest
{

     /**
     * @OA\Property(
     *      title="Transaction Description",
     *      description="Description of the transaction ",
     *      example="save for a while"
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
            'description' => 'string',
            'amount' => 'required|numeric|min:0.1|max:100000000',
        ];
    }
}
