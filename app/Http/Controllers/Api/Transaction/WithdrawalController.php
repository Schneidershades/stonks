<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Services\ProcessTransactionService;
use App\Http\Requests\Transaction\WithdrawalFormRequest;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
	/**
     * @OA\Post(
     *      path="/api/v1/transaction/withdrawal",
     *      operationId="withdrawal",
     *      tags={"Transaction"},
     *      summary="Processes a withdrawal",
     *      description="Processes a withdrawal transaction of an authenticated user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/WithdrawalFormRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful signup",
     *          @OA\MediaType(
     *             mediaType="application/json",
     *         ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={ {"bearerAuth": {}} },
     * )
     */
    public function store(WithdrawalFormRequest $request)
    {
    	$transaction = (new ProcessTransactionService())->process($request, 'withdrawal');

    	return $this->showMessage($transaction['message'], $transaction['code']);
    }
}
