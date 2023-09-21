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

    public function customerIndex(){
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function createCustomer(){
        return view('admin.customers.create');
    }

    public function storeCustomer(Request $request){
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

    public function destroyCustomer(Customer $customer){
        $customer->delete();
        return redirect('/admin')->with('success', 'Klant is verwijderd!');
    }
}
