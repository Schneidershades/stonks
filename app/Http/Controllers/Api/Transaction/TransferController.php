<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Services\ProcessTransactionService;
use App\Http\Requests\Transaction\TransferFormRequest;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
	 /**
     * @OA\Post(
     *      path="/api/v1/transaction/transfer",
     *      operationId="transfer",
     *      tags={"Transaction"},
     *      summary="Processes a transfer",
     *      description="Processes a transfer transaction of an authenticated user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TransferFormRequest")
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

    public function store(TransferFormRequest $request)
    {
    	$transaction = (new ProcessTransactionService())->process($request, 'transfer');

    	return $this->showMessage($transaction['message'], $transaction['code']);
    }
}
