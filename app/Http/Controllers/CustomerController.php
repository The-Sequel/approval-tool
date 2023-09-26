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
                    'field' => 'text',
                    'content' => $value['name'],
                ],
                [
                    'field' => 'image',
                    'content' => $value['logo'] ? '<img src="/storage/' . $value['logo'] . '" width="100px" height="100px">' : 'No image',
                    
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
        // $customers = Customer::all();
        // return view('admin.customers.index', compact('customers'));
    }

    public function create(){
        return view('admin.customers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'debtor_number' => 'required',
        ]);
        
        // if(!Storage::disk('public_uploads')->put($request->file('logo'), 'public') {
        //     return false;
        // }

        // if(!Storage::disk('public/uploads')->put($request->file('logo'), 'public')) {
        //     return false;
        // }

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
}
