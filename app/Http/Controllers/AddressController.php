<?php

namespace App\Http\Controllers;

use App\Services\AddressService;

use App\Http\Request;

use App\Validators\Validator;

class AddressController
{
    private $addressService;
    public function __construct()
    {
        $this->addressService = new AddressService();
    }

    public function index()
    {
        // getting request data
        $request = (new Request())->getParams;
        // getting validation results
        $errors = (new Validator())->validate($request, [
            'page' => 'integer'
        ]);

        // set page
        $page = isset($request["page"]) && !isset($errors["page"]) && $request["page"] > 1 ? $request["page"] : 1;
        
        // load data
        $data = $this->addressService->paginate($page);

        require_once APP_ROOT . '/views/index.php';
    }

    public function create()
    {

        $request = (new Request());

        if ($request->method === 'POST') {
            $requestParams = $request->postParams;
            
            // validating request
            $errors = (new Validator())->validate($requestParams, [
                'first_name' => 'required',
                'last_name' => 'required',
                'street' => 'required',
                'postal' => 'required',
                'city' => 'required',
            ]);

            if (count($errors) === 0) {
                $errors = $this->addressService->create($requestParams);
            }
        }



        require_once APP_ROOT . '/views/create.php';
    }
}
