<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\FinishingProductExport;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\FinishingProductModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class FinishingProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $finishing_product = FinishingProductModel::all();
        $product_size = ProductSize::all();
        return view('pages.master.finishing_product.index',compact('product', 'finishing_product', 'product_size'));
    }
    public function indexData(Request $request)
    {
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $product = $request->input('product');
        $finishing_product_model = $request->input('finishing_product_model');
        $product_size = $request->input('product_size');
        $dateFilter = $request->input('date_filter');

        // Start building the query
        $query = FinishingProductModel::with(['product', 'productSize']);

        // Apply date filter (e.g., today, this_month, last_month)
        if ($dateFilter) {
            if ($dateFilter === 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($dateFilter === 'this_month') {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            } elseif ($dateFilter === 'last_month') {
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
            }
        }

        // Apply date range filter
        if ($fromDate && $lastDate) {
            $query->whereBetween('created_at', [$fromDate, $lastDate]);
        }

        // Apply product filter
        if ($product) {
            $query->where('product_id', $product);
        }

        // Apply finishing product model filter
        if ($finishing_product_model) {
            $query->where('id', $finishing_product_model);
        }

        // Apply product size filter
        if ($product_size) {
            $query->where('product_size_id', $product_size);
        }

        // Return the data using DataTables
        return DataTables::of($query)->make(true);
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
        $finishing_product->meters_one_product = $request->input('meters_one_product');
        $finishing_product->wages_one_product = $request->input('wages_one_product');
        $finishing_product->cutting_charge = $request->input('cutting_charges');
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
        $finishing_product->meters_one_product = $request->input('meters_one_product');
        $finishing_product->wages_one_product = $request->input('wages_one_product');
        $finishing_product->cutting_charge = $request->input('cutting_charges');
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
