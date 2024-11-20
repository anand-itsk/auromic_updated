<?php

namespace App\Http\Controllers\PageControllers\MasterControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ModelDataImport;
use App\Exports\ModelExport;
use App\Models\RawMaterial;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductModel;
use App\Models\ProductModelHistory;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ProductModelController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $product_model = ProductModel::all();
        $product_size = ProductSize::all();
        return view('pages.master.product_model.index',compact('product','product_model','product_size'));
    }

    public function indexData(Request $request)
    {
        $fromDate = $request->input('from_date');
        $lastDate = $request->input('last_date');
        $product = $request->input('product');
        $product_model = $request->input('product_model');
        $product_size = $request->input('product_size');
        $dateFilter = $request->input('date_filter');

        // Start building the query
        $query = ProductModel::with(['rawMaterial.rawMaterialType', 'product', 'productSize']);

        // Apply date filter
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

        // Filter by date range
        if ($fromDate && $lastDate) {
            $query->whereBetween('date', [$fromDate, $lastDate]);
        }

        // Filter by product ID
        if ($product) {
            $query->where('product_id', $product);
        }
        if ($product_model) {
            $query->where('id', $product_model);
        }
        if ($product_size) {
            $query->where('product_size_id', $product_size);
        }

        // Execute the query and return the DataTables response
        return DataTables::of($query)->make(true);
    }


    public function create()
    {


        $raw_material = RawMaterial::all();
        $product = Product::all();
        $product_size = ProductSize::all();
        return view('pages.master.product_model.create', compact('raw_material', 'product', 'product_size'));
    }

    public function checkName(Request $request)
    {

        $model_code = $request->input('model_code'); 

        $exists = ProductModel::where('model_code', $model_code)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'product_id' => 'required',
            'model_code' => 'unique:product_models',
            'model_name' => 'required',
            'raw_material_weight_item' => 'required|numeric|between:0,99999.999',
        ]);

        $product_model = new ProductModel;
        $product_model->raw_material_id = $request->input('raw_material_id');
        $product_model->product_id = $request->input('product_id');
        $product_model->product_size_id  = $request->input('product_size_id');
        $product_model->model_code = $request->input('model_code');
        $product_model->model_name = $request->input('model_name');
        $product_model->raw_material_weight_item = number_format((float)$request->input('raw_material_weight_item'), 3, '.', '');

        $product_model->wages_product = $request->input('wages_product');
        $product_model->date = $request->input('date');
        //    dd($product_model);
        $product_model->save();

        


        return redirect()->route('master.product_model.index')
            ->with('success', 'Product Model created successfully');
    }

    public function edit($id)
    {
        $product_model = ProductModel::find($id);
        $raw_material = RawMaterial::all();
        $product = Product::all();
        $product_size = ProductSize::all();

        return view('pages.master.product_model.edit', compact('product_model', 'raw_material', 'product', 'product_size'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'product_id' => 'required',
            'model_code' => 'required',
            'model_name' => 'required',
        ]);

        $product_model = ProductModel::find($id);
        $product_model->raw_material_id = $request->input('raw_material_id');
        $product_model->product_id = $request->input('product_id');
        $product_model->product_size_id  = $request->input('product_size_id');
        $product_model->model_code = $request->input('model_code');
        $product_model->model_name = $request->input('model_name');
        $product_model->raw_material_weight_item = $request->input('raw_material_weight_item');
        $product_model->wages_product = $request->input('wages_product');
        $product_model->date = $request->input('date');
        //    dd($product_model);
        $product_model->save(); 


        return redirect()->route('master.product_model.index')
            ->with('success', 'Product Model Updated successfully');
    }

    public function delete($id)
    {
        $product_model = ProductModel::find($id);

        $product_model->delete();

        return redirect()->route('master.product_model.index')->with('success', 'Product Model Deleted successfully!');
    }

    public function deleteSelected(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid input'], 400);
        }

        ProductModel::destroy($ids);
        return response()->json(['status' => 'success']);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($request->all()), 'ProductModelDatas_' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new ModelDataImport, request()->file('file'));

        return redirect()->route('master.product_model.index')->with('success', 'Data imported successfully');
    }

    public function destroy($id)
    {
        $raw_material = ProductModel::find($id);

        $raw_material->delete();
    }

    public function getProductModel($id)
    {
        // dd($id);
        $productModel = ProductModel::find($id);
        return response()->json($productModel);
    }
    public function priceUpdate(Request $request)
    {
        // Validate the request to ensure all required fields are provided
        $validated = $request->validate([
            'id' => 'required|integer|exists:product_models,id', // Ensure product model ID exists
            'wages_product' => 'required|string',
            'date' => 'required|date',
            // Add validation for any other fields you need to store
        ]);

        // Save the ProductModelHistory record
        $productModelHistory = new ProductModelHistory();
        $productModelHistory->product_model_id = $request->id; // Assign the product_model_id
        $productModelHistory->wages_product = $request->wages_product; // Store the wages_product
        $productModelHistory->date = $request->date; // Store the date
        $productModelHistory->save();

        // Update the `ProductModel` with the new `wages_product` and `date`
        $productModel = ProductModel::find($request->id);
        $productModel->wages_product = $request->wages_product;
        $productModel->date = $request->date;
        $productModel->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Data created and ProductModel updated successfully']);
    }


    public function getProductModelHistory($id)
    {
        // Fetch ProductModelHistory data and join with the product_models table to get model_code and model_name
        $history = ProductModelHistory::where('product_model_id', $id)
            ->join('product_models', 'product_models.id', '=', 'product_model_histories.product_model_id')
            ->select('product_model_histories.*', 'product_models.model_code', 'product_models.model_name')
            ->get();

        // Format created_at as 'd/m/Y H:i' (day/month/year hour:minute)
        foreach ($history as $item) {
            // Format the created_at as 'd/m/Y h:i A' where:
            // d = day, m = month, Y = year, h = hour (12-hour format), i = minutes, A = AM/PM
            $item->formatted_created_at = \Carbon\Carbon::parse($item->created_at)->format('d/m/Y h:i A');
        }


        // Return the data as JSON response
        if ($history->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No data found']);
        }

        return response()->json(['success' => true, 'data' => $history]);
    }



}
