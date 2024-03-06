<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        if($employees->count() > 0){

            return response()->json([   
                'status' => 200,
                'employees' => $employees

            ]);
        }else{
            return response()->json([
                'status' => 404,
                'employees' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|string|max:191',
            'LastName'=> 'required|string|max:191',
            'email'=> 'required|email|max:191',
            'phone'=> 'required|digits:11',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            
            $employees = Employee::create([
                'firstName'=> $request->firstName,
                'LastName'=> $request->LastName,
                'email'=> $request->email,
                'phone'=> $request->phone,
            ]);

            if($employees){

                return response()->json([
                    'status' => 200,
                    'message' => "Employee Created Successfully"
                ],200);
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ],500);
            }

        }
    } 
    public function show($id)
    {
        $employees = Employee::find($id);
        if($employees){

            return response()->json([
                'status' => 200,
                'Employee' => $employees
            ],200);  
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Employee Found!"
            ],404);

        }
    }
    public function edit($id)
    {
        $employees = Employee::find($id);
        if($employees){

            return response()->json([
                'status' => 200,
                'Employee' => $employees
            ],200);  
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Employee Found!"
            ],404);

        }
    }
    
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|string|max:191',
            'LastName'=> 'required|string|max:191',
            'email'=> 'required|email|max:191',
            'phone'=> 'required|digits:11',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            $employees = Employee::find($id);
            if($employees){

                $employees->update([
                    'firstName'=> $request->firstName,
                    'LastName'=> $request->LastName,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                ]);              

                return response()->json([
                    'status' => 200,
                    'message' => "Employee updated Successfully"
                ],200);
            }else{

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Student Found"
                ],404);
            }

        }
    }

    public function destroy($id)
    {
        $employees = Employee::find($id);
        if($employees){

            $employees->delete();
            return response()->json([
                'status' => 200,
                'message' => "Employee Deleted Successfully!"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Employee Found! "
            ],404);




            
        }
    }
}
