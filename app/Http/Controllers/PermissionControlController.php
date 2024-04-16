<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PermissionControlController extends Controller
{
      public function index()
      {
         return view('settings.masters.permission_control.index');
      }

       public function indexData()
    {
        
        $permission_control = Permission::get();
        
        return DataTables::of($permission_control)->make(true);
    }

       public function create()
    {
           $permission_group = PermissionGroup::get();
  
        return view('settings.masters.permission_control.create',compact('permission_group'));
    }

     public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $permission_control = new Permission;
        $permission_control->name = $request->input('name');
        $permission_control->permission_group_id = $request->input('permission_group_id');
        
       
   
        $permission_control->save();

        return redirect()->route('user-management.permission_control')->with('success', 'Permission added successfully!');


     }

     public function edit($id)
     {
        $permission_control= Permission::find($id);
         $permission_group = PermissionGroup::get();
      
        return view('settings.masters.permission_control.edit', compact('permission_control','permission_group'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            
        ]);
    
        $permission_control = Permission::find($id);
        $permission_control->name = $request->input('name');
        $permission_control->permission_group_id = $request->input('permission_group_id');
        $permission_control->save();
    
          return redirect()->route('user-management.permission_control')->with('success', 'Permission updated successfully!');
    }

    public function delete($id)
    {
        $permission_control = Permission::findOrFail($id);
        $permission_control->delete();

        // return response()->json(['success' => 'Company deleted successfully']);
    }

}