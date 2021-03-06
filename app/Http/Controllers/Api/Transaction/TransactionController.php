<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
	/**
    * @OA\Get(
    *      path="/api/v1/transaction/transactions",
    *      operationId="allTransactions",
    *      tags={"Transaction"},
    *      summary="Profile of a registered user",
    *      description="Profile of a registered user",
    *      @OA\Response(
    *          response=200,
    *          description="Successful signin",
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
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
                            ->orWhere('receiver_id', auth()->user()->id)
                            ->latest()
                            ->get();

    	return $this->showAll($transactions);
    }
}
