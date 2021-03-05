<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\DepositFormRequest;
use App\Services\ProcessTransactionService;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
	 /**
     * @OA\Post(
     *      path="/api/v1/transaction/deposit",
     *      operationId="deposit",
     *      tags={"Transaction"},
     *      summary="Processes a deposit",
     *      description="Processes a deposit transaction of an authenticated user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/DepositFormRequest")
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
    public function store(DepositFormRequest $request)
    {
    	$transaction = (new ProcessTransactionService())->process($request, 'deposit');

    	return $this->showMessage($transaction['message'], $transaction['code']);
    }
}
