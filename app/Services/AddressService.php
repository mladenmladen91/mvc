<?php


namespace App\Services;

use App\Repositories\AddressRepository;


class AddressService
{
    private array $errors = [];

    // getting category data from the repository and send them to the controller
    public function paginate($page)
    {
        $addressRepository = new AddressRepository();
        return $addressRepository->paginate($page);
    }
    // accepting the request and pass it to the saving repository
    public function create($request): array
    {
        $addressRepository = new AddressRepository();
        // check address first
        $this->checkAddress($request);
        // if no errors continue
        if (count($this->errors) === 0) {

            $addressRepository->create($request);
        }

        return $this->errors;
    }

    protected function checkAddress($request)
    {
        // create a new cURL resource
        $url = 'https://interview.performance-technologies.de/api/address?token=' . API_TOKEN . '&city=' . urlencode($request["city"]) . '&street=' . urlencode($request["street"]) . '&postal=' . urlencode($request["postal"]) . '&country=' . urlencode($request["country"]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if ($result["success"] === "false") {
            foreach ($result["error"] as $key => $value) {
                $this->errors[$key] = $value[0];
            }
        }
    }
}
