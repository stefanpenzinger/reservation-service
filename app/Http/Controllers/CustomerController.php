<?php

namespace App\Http\Controllers;

use App\Service\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    public function create(Request $request) {
        try {
            $customerService = new CustomerService();

            $data = $request->all();
            $customerService->createCustomer($data['firstName'], $data['lastName'], $data['mobile'], $data['email']);

            return response()->setStatusCode(ResponseAlias::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->setStatusCode(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
