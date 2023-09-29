<?php

namespace App\Http\Controllers;

use App\Models\Customer;

// Models
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Customer side




    // Admin side

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
        ]);
       
        // Redirect the user
        return redirect('/admin/customers');
    }

    public function destory(Customer $customer){
        $customer->delete();
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

        if($file = $request->file('logo')){
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = null;
        }

        $customer->logo = $filePath;
        
        $customer->update();

        return redirect('/admin/customers')->with('success', 'Klant is aangepast!');
    }
}
