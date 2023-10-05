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

        $options_array = Customer::get()->toArray();

        foreach ($options_array as $key => $value) {
            $options_array[$key]['users'] = Customer::find($value['id'])->users()->get()->toArray();
        }

        $tbody = [];
        foreach ($options_array as $key => $value) {
            $tbody[$value['id']] = [
                [
                    'field' => 'link',
                    'content' => $value['name'],
                    'href' => '/admin/customers/edit' . $value['id'] . '/edit',
                ],
                [
                    'field' => 'image',
                    'content' => $value['logo'] ? '/storage/' . $value['logo'] : 'No image',
                    'class' => 'table img',
                    
                ],
                [
                    'field' => 'text',
                    'content' => $value['status'],
                ],
                [
                    'field' => 'text',
                    'content' => $value['users'] ? implode(', ', array_column($value['users'], 'name')) : '-',
                ],
                [
                    'field' => 'text',
                    'content' => $value['debtor_number'],
                ],
            ];
        }

        $table = [
            'thead' => [
                'Klanten',
                'Logo',
                'Status',
                'Contactpersoon',
                'Debiteur nummer',
            ],

            'tbody' => $tbody,
        ];
        
        return view('admin.customers.index', compact('table', 'customers'));
    }

    public function create(){
        return view('admin.customers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'debtor_number' => 'required',
        ]);

        if($file = $request->file('logo')){
            $fileName = $file->getClientOriginalName();
            // can you store the file to this path public\storage/uploads/
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // $filePath = $file->storeAs('uploads', $fileName);
        } else {
            $filePath = null;
        }

        Customer::create([
            'name' => $request->name,
            'debtor_number' => $request->debtor_number,
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
        return redirect('/admin/customers');
    }

    public function destroy(Customer $customer){
        dd($customer);

        return redirect('/admin')->with('success', 'Klant is verwijderd!');
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
