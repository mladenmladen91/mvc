<?php

namespace App\Http\Controllers;

use App\Models\Address;

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

        // load addresses and pagination logic
        $page = isset($request["page"]) && !isset($errors["page"]) && $request["page"] > 1 ? $request["page"] : 1;
        $data = $this->addressService->paginate($page);
        $data->page = ($page > 0 && $page <= $data->pages) ? $page : 1;
        $data->next = ($page + 1 <= $data->pages)  ? $page + 1 : null;
        $data->previous = ($page > 1)  ? $page - 1 : null;


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
