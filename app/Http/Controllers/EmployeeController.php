<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
class EmployeeController extends Controller
{
    public function index(){
      return view('employees.content_index');
    }

    public function getemployees()
    {
        $employee = Employee::all();
        return datatables()->of($employee)
        ->editColumn('thumbnail',function($employee){
            return'<img src="'.asset('').'storage/'.$employee->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        })
        ->addColumn('action',function($employee){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$employee->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$employee->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$employee->id.'">Delete</a></li>
                          </ul>
                        </div>
                    </div>
                     ';
            
        })
        ->rawColumns(['thumbnail','action'])
        ->toJson();
    }
 //    public function addtest(PostStoreRequest $request)
 //    {
 //        dd('done');
 //    }

    public function store(Request $request)
    {

      $path = $request->thumbnail->storeAs('employee_img',$request->thumbnail->getClientOriginalName());
      $employee=Employee::create([
      'name' => request('name'),
      'thumbnail' => $path,
      'address' => request('address'),
      'email' => request('email'),
      'phone' => request('phone'),
      'user_id' => request('user_id'),
      'level_user' => request('level_user'),
      ]);
      return response()->json(['employee'=>$employee],200);
    }

    public function show($id)
    {
        $employee=Employee::find($id);
        // dd($product);
        return response()->json(['data'=>$employee],200);
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        //die($post);
        return response()->json(['data'=>$employee],200);
    }

    public function update(Request $request, $id)
  {

        $path = $request->thumbnail->storeAs('employee_img',$request->thumbnail->getClientOriginalName());

         $employee = Employee::find($id);
         $employee->name = $request->name;
         $employee->address = $request->address;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->user_id = $request->user_id;
         $employee->level_user = $request->level_user;
         $employee->thumbnail =  $path;
         $employee->save();
    
       return response()->json(['data'=>$employee],200);
  }

    public function destroy($id)
  {
      Employee::where('id',$id)->delete();
      return response()->json(['data'=>'removed'],200);
  }
}
