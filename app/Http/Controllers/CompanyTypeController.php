<?php

namespace App\Http\Controllers;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CompanyTypeController extends Controller
{
      public function index()
     {
        
        $company_type = CompanyType::paginate(10);
    //   dd($company_type);
        return view('settings.masters.company_type.index',compact('company_type'));

     }

     public function indexData()
    {
        
        $company_type = CompanyType::get();
        
        return DataTables::of($company_type)->make(true);
    }

      public function create()
     {
        
        return view('settings.masters.company_type.create');

     }

       public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
        
        $company_type = new CompanyType;
        $company_type->name = $request->input('name');
        $company_type->code = $request->input('code');
       
   
        $company_type->save();

        return redirect()->route('specified.company_types')->with('success', 'company type added successfully!');


     }

      public function edit($id)
     {
        $company_type= CompanyType::find($id);
      
        return view('settings.masters.company_type.edit', compact('company_type'));
       
     }

     public function update(Request $request, $id)
    {
          $request->validate([
            'name' => 'required',
            'code' => 'required',
            
        ]);
    
        $company_type = CompanyType::find($id);
        $company_type->name = $request->input('name');
        $company_type->code = $request->input('code');
        $company_type->save();
    
         return redirect()->route('specified.company_types')->with('success', 'company type Updated successfully!');
    }
        public function delete($id)
    {
          $company_type = CompanyType::find($id);

         $company_type->delete();

          return redirect()->route('specified.company_types')->with('success', 'company type Deleted successfully!');

    }

       public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        CompanyType::destroy($ids);
        return response()->json(['status' => 'success']);
    }
}
