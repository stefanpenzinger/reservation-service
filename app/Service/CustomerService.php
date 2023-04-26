<?php

namespace App\Service;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerService
{

    /**
     * @param int $id
     * @return mixed
     */
    public function getCustomer(int $id)
    {
       return Customer::firstOrFail($id);
    }

    /**
     * @return Collection
     */
    public function getCustomers() {
        return Customer::all();
    }

    public function createCustomer(string $firstName, string $lastName, string $mobile, string $email) {
        $customer = Customer::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'mobile' => $mobile,
            'email' => $email
        ]);

        $customer->save();
    }

    public function deleteCustomer(int $id) {

    }
}
