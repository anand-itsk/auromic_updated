<style>
    .modal-dialog-scrollable .modal-body {
        overflow-y: scroll !important;
        overflow-x: hidden !important;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999999;
    }

    span.select2-container.select2-container--default.select2-container--open {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        z-index: 999999;
    }
</style>
</style>


<!--  Raw Material Modal -->
<div class="modal fade raw_material" id="raw_material" tabindex="9999" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Raw Material
                    Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rawmaterialForm">

                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="raw_material_type_id" class="form-label">Raw
                        Material Type</label>
                    <select class="form-control raw_material_type_id" name="raw_material_type_id">
                        <option value="">Select Type</option>
                        @foreach ($raw_material_type as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('raw_material_type_id')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control raw_material_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="stock" class="form-label mandatory">stock</label>

                    <input class="form-control raw_material_stock" type="number" name="stock" id="stock">
                    @error('stock')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="saveRawMaterial" class="btn btn-primary">Save
                            changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Product  Modal --}}
<div class="modal fade" id="product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveProduct" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End  --}}

{{-- Product Size Modal --}}
<div class="modal fade" id="product_size" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Size Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productsizeForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control" type="text" name="name" id="name1">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveProductSize" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Product color Modal --}}
<div class="modal fade product_color" id="product_color" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Color Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productcolorForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control product_color_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control product_color_code" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveProductColor" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}


{{-- Product_model Modal --}}

<div class="modal fade product_model bd-example-modal-lg" id="product_models" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Model Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productmodelForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">

                    <!-- Raw Material Section -->
                    <div class="form-group">
                        <label class="col-form-label mandatory">
                            Raw Material
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#raw_material">+</button>
                        </label>
                        <select class="form-control pm_raw_material_id select2 z-2" name="raw_material_id"
                            id="raw_material_id" required>
                            <option value="">Select Raw Material</option>
                            @foreach ($raw_material as $item)
                                <option class="" style="" value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('raw_material_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Product Section -->
                    <div class="form-group">
                        <label class="col-form-label mandatory">
                            Product
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#product">+</button>
                        </label>
                        <select class="form-control pm_products select2" name="product_id" id="products" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="col-form-label mandatory">
                            Product Size
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#product_size">
                                +
                            </button>

                        </label>
                        <select class="form-control pm_product_size_id  select2" name="product_size_id"
                            id="product_size_id"required>
                            <option value="">Select Product Size</option>
                            @foreach ($product_size as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('product_size_id')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label for="model_code" class="col-form-label mandatory">
                            Model Code
                        </label>
                        <input class="form-control pm_model_code" type="text" name="model_code"
                            id="model_code"required>
                        <div id="model_codeError" style="color: red;"></div>
                        @error('model_code')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for="model_name" class="col-form-label mandatory">
                            Model Name
                        </label>
                        <input class="form-control pm_model_name" type="text" name="model_name"
                            id="model_name"required>
                        @error('model_name')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer_code" class="col-form-label mandatory">Req raw
                            Material
                            weight/item</label>

                        <input class="form-control pm_raw_material_weight_item" type="text"
                            name="raw_material_weight_item" id="raw_material_weight_item" value="" required>
                        @error('raw_material_weight_item')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="wages_product" class="col-form-label">Wages for 1
                            product</label>
                        <input class="form-control pm_wages_product" type="text" name="wages_product"
                            id="wages_product" value="{{ old('wages_product', 0) }}">
                        @error('wages_product')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer_code" class="col-form-label  mandatory">Date
                        </label>

                        <input class="form-control pm_date" type="date" name="date" id="date"required>
                        @error('date')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveProductModel" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Religion Modal --}}
<div class="modal fade religion" id="religion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="z-index: 9999999">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Religion Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="religionForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control religion_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control religion_code" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveReligion" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Caste Modal --}}
<div class="modal fade caste" id="caste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Caste Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="casteForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control caste_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control caste_code" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveCaste" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Nationality Modal --}}
<div class="modal fade nationality" id="nationality" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nationality Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="nationalityForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control nationality_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control nationality_code" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveNationality" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}


{{-- Resigning Reason Modal --}}
<div class="modal fade resigning_reason" id="resigning_reason" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resigning Reason Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="resigningreasonForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control resigningreason_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control resigningreason_code" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveResigningReason" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}


{{-- ESI Dispensary Modal --}}
<div class="modal fade esi_dispensary" id="esi_dispensary" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ESI Dispensary Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="esidispensaryForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <label for="name" class="form-label mandatory">Name</label>
                    <input class="form-control esidispensary_name" type="text" name="name" id="name">
                    @error('name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror

                    <label for="firstNameinput" class="form-label">Code</label>
                    <input class="form-control esidispensary_code" type="text" name="code" id="code">
                    @error('code')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveEsiDispensary" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}

{{-- Customer Modal --}}
<div class="modal fade customer" id="customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="z-index: 9999999">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="customerForm">
                    @csrf
                    <input type="hidden" name="ajax_mode" value="ajax">
                    <div class="form-group row">
                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Customer
                            Code</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_code" type="text" name="customer_code"
                                id="customer_code" required>
                            @error('customer_code')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>


                        <label for="customer_name" class="col-sm-2 col-form-label mandatory">Customer
                            Name</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_name" type="text" name="customer_name"
                                id="customer_name" required>
                            @error('customer_name')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Office Addresses --}}
                    <div class="form-group row">
                        <label for="office_address" class="col-sm-2 col-form-label">Office Address</label>
                        <div class="col-sm-4 mb-4">
                            <textarea class="form-control customer_office_address" name="office_address" id="office_address" cols="10"
                                rows="3"></textarea>

                            @error('office_address')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control customer_office_country_id select2" name="office_country_id"
                                id="office_country_id">
                                @foreach ($countries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('office_country_id')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="col-sm-2 col-form-label">State</label>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control customer_office_state_id select2 w-100" name="office_state_id"
                                id="office_state_id" disabled>
                            </select>
                            @error('office_state_id')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="office_pincode" class="col-sm-2 col-form-label">Pincode</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_office_pincode " type="text" name="office_pincode"
                                id="office_pincode">
                            @error('office_pincode')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="phone_no" class="col-sm-2 col-form-label">Phone No</label>
                        <div class="col-sm-1 mb-4">
                            <input class="form-control customer_std_code" type="std_code" name="std_code"
                                id="std_code">
                            @error('std_code')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-4">
                            <input class="form-control customer_phone" type="text" name="phone" id="phone">
                            @error('phone')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <h4>Personal Info</h4>
                    <div class="form-group row">

                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-4 mb-4">
                            <textarea class="form-control customer_address" name="address" id="address" cols="10" rows="3"></textarea>
                            @error('address')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control customer_country_id select2" name="country_id"
                                id="country_id">
                                @foreach ($countries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="col-sm-2 col-form-label">State</label>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control customer_state_id select2" name="state_id" id="state_id"
                                disabled>
                            </select>
                            @error('state_id')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="pincode" class="col-sm-2 col-form-label">Pincode</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_pincode" type="text" name="pincode"
                                id="pincode">
                            @error('pincode')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="phone_no" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_mobile" type="text" name="mobile"
                                id="mobile">
                            @error('mobile')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Other Details --}}
                    <div class="form-group row">

                        <label for="email" class="col-sm-2 col-form-label">Email Id</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_email" type="email" name="email" id="email">
                            @error('email')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="website" class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_website" type="text" name="website"
                                id="website">
                            @error('website')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="tin_no" class="col-sm-2 col-form-label">Pan No</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_pan_no" type="text" name="pan_no"
                                id="pan_no">
                            @error('pan_no')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="tin_date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_pan_date" type="date" name="pan_date"
                                id="pan_date">
                            @error('pan_date')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="gst_no" class="col-sm-2 col-form-label">GST No</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_gst_no" type="text" name="gst_no"
                                id="gst_no">
                            @error('gst_no')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="cst_date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4 mb-4">
                            <input class="form-control customer_gst_date" type="date" name="gst_date"
                                id="gst_date">
                            @error('gst_date')
                                <span class="error" style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveCustomer" class="btn btn-primary">Save
                    changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End --}}
