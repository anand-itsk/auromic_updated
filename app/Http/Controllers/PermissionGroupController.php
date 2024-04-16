<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class PermissionGroupController extends Controller
{
     public function index()
      {
         return view('settings.masters.permission_group.index');
      }

       public function indexData()
    {
        
        $permission_group = PermissionGroup::get();
        
        return DataTables::of($permission_group)->make(true);
    }
       public function create()
    {
           
  
        return view('settings.masters.permission_group.create');
    }

     public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $permission_group = new PermissionGroup;
        $permission_group->name = $request->input('name');
       
        
       
   
        $permission_group->save();

        return redirect()->route('user-management.permission_group')->with('success', 'Permission Group added successfully!');


     }

      public function edit($id)
     {
        
         $permission_group = PermissionGroup::find($id);
      
        return view('settings.masters.permission_group.edit', compact('permission_group'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            
        ]);
    
        $permission_group = PermissionGroup::find($id);
        $permission_group->name = $request->input('name');
       
        $permission_group->save();
    
          return redirect()->route('user-management.permission_group')->with('success', 'Permission Group updated successfully!');
    }

    public function delete($id)
    {
        $permission_group = PermissionGroup::findOrFail($id);
        $permission_group->delete();

        // return response()->json(['success' => 'Company deleted successfully']);
    }


}
