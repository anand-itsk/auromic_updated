<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\FinishingProductExport;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\FinishingProductModel;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class FinishingProductController extends Controller
{
    public function index()
    {
        return view('pages.master.finishing_product.index');
    }
    public function indexData()
    {

        $finishing_product = FinishingProductModel::with(['product', 'productSize'])->get();

        return DataTables::of($finishing_product)->make(true);
    }
    public function create()
    {
        $products = Product::all();
        $product_size = ProductSize::get();
        return view('pages.master.finishing_product.create', compact('products', 'product_size'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'model_code' => 'required',
        ]);

        $finishing_product = new FinishingProductModel;
        $finishing_product->product_id = $request->input('product_id');
        $finishing_product->product_size_id = $request->input('product_size_id');
        $finishing_product->model_code = $request->input('model_code');
        $finishing_product->model_name = $request->input('model_name');
        $finishing_product->wages_one_product = $request->input('meters_one_product');
        $finishing_product->cutting_charge = $request->input('cutting_charge');
        $finishing_product->date = $request->input('date');

        //    dd($finishing_product); 

        $finishing_product->save();


        return redirect()->route('master.finishing_product.index')
            ->with('success', ' Finishing Product created successfully');
    }

    public function edit($id)
    {
        $finishing_product = FinishingProductModel::find($id);
        $products = Product::all();
        $product_size = ProductSize::all();
        return view('pages.master.finishing_product.edit', compact('products', 'product_size', 'finishing_product'));
    }
    public function update(Request $request, $id)
    {
        // dd($request);

        $finishing_product =  FinishingProductModel::find($id);
        $finishing_product->product_id = $request->input('product_id');
        $finishing_product->product_size_id = $request->input('product_size_id');
        $finishing_product->model_code = $request->input('model_code');
        $finishing_product->model_name = $request->input('model_name');
        $finishing_product->wages_one_product = $request->input('wages_one_product');
        $finishing_product->date = $request->input('date');

        //    dd($finishing_product); 

        $finishing_product->save();


        return redirect()->route('master.finishing_product.index')
            ->with('success', ' Finishing Product Updated successfully');
    }
    public function delete($id)
    {
        $finishing_product = FinishingProductModel::find($id);

        $finishing_product->delete();

        return redirect()->route('master.finishing_product.index')->with('success', 'Finishing Product Deleted successfully!');
    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        FinishingProductModel::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function export(Request $request)
    {
        return Excel::download(new FinishingProductExport($request->all()), 'FinishingProductDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new FinishingProductImport, request()->file('file'));

        return redirect()->route('master.finishing_product.index')->with('success', 'Data imported successfully');
    }
}
