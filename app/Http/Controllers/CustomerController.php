<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    
    public function index()
    {
        $categories = Customer::orderBy('id','DESC')->get();
        return response()->json($categories);
    }

    public function submit(Request $request)
    {
       
        $validation = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'address' => 'required',
            'photo' => 'required|image',
        ];

        if((int)$request->id){
            unset($validation['photo']);
        }
        
        $this->validate($request, $validation);

        $modalData = [
            'name'=> $request->name,
            'surname'=> $request->surname,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'company'=> $request->company,
            'address'=> $request->address,
        ];

        if($request->has('photo')){
            $modalData['photo'] = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $modalData['photo']);
        }

        if((int)$request->id){
            Customer::where('id', (int)$request->id)->update($modalData);
        } else {
            Customer::create($modalData);
        }

        return response()->json([
            'message'=>'Customer Data Updated Successfully!!',
            'success'=> true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([
            'message'=>'Customer Deleted Successfully!!'
        ]);
    }
}
