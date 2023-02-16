<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
// Import Autorizacion Policies:
use Illuminate\Support\Facades\Gate;
// Import Resource:
use App\Http\Resources\CustomerResource;


class CustomerController extends Controller {
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->authorizeResource(Customer::class, 'customer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // SEARCH BAR:
        /*$num_elementos = $request->input('numElements');
        $busqueda_keys = ['first_name', 'last_name', 'city', 'country', 'fecha_nacimiento'];
        $registros = searchByField($busqueda_keys, Customer::class);
        return CustomerResource::collection($registros->paginate($num_elementos));*/
        // Show Only The Current User Profile:
        $user = $request->user();
        $registros = ($user->isAdmin())
            ? CustomerResource::collection(Customer::all())
            : CustomerResource::collection([($user->customer) ? $user->customer : Customer::find(1)]);
        return $registros;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Autorizacion Sin Modelo/Policies:
        //if ($request->user()->cannot('update', Customer::class)) abort(403);
        $customer = json_decode($request->getContent(), true);
        $customer = Customer::create($customer['data']['attributes']);
        return new CustomerResource($customer);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer) {
        return new CustomerResource($customer);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer) {
        // Autorizacion Con Modelo/Policies:
        //if ($request->user()->cannot('update', $customer)) abort(403);
        $customerData = json_decode($request->getContent(), true);
        $customer->update($customerData['data']['attributes']);
        return new CustomerResource($customer);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer) {
        $customer->delete();
    }
}
