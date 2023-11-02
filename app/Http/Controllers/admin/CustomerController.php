<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){

        $customers = Customer::all();
        
        return view('admin.customers.index', compact('customers'));
    }

    public function create(){
        return view('admin.customers.create');
    }

    public function store(Request $request){
        if($request->name == null){
            return redirect()->back()->with('error', 'Vul een naam in!');
        } elseif($request->logo == null){
            return redirect()->back()->with('error', 'Upload een logo!');
        }

        if($file = $request->file('logo')){
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // $filePath = $file->storeAs('uploads', $fileName);
        } else {
            $filePath = null;
        }

        Customer::create([
            'name' => $request->name,
            'debtor_number' => 12312312,
            'logo' => $filePath,
            'address' => $request->address,
            'postal_code' => $request->zipcode,
            'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'kvk' => $request->kvk,
            'btw' => $request->btw,
        ]);
       
        // Redirect the user
        return redirect('/admin/customers')->with('success', 'Klant is aangemaakt!');
    }

    public function destroy(Customer $customer){
        $customer->delete();

        return redirect('/admin/customers')->with('success', 'Klant is verwijderd!');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Customer $customer, Request $request)
    {
        $customer->name = $request->name;
        $customer->debtor_number = $request->debtor_number;
        $customer->status = $request->status;
        $customer->address = $request->address;
        $customer->postal_code = $request->postal_code;
        $customer->city = $request->city;
        $customer->phone = $request->phone_number;
        $customer->email = $request->email;
        $customer->kvk = $request->kvk_number;
        $customer->btw = $request->btw_number;

        if($file = $request->file('logo')){
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = '';
        }

        $customer->logo = $filePath;
        
        $customer->update();

        return redirect('/admin/customers')->with('success', 'Klant is aangepast!');
    }
}
