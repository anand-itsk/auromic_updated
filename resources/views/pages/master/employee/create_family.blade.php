<div class="tab-pane" role="tabpanel" id="step3">
    <h4 class="text-center pb-4">Family</h4>
    {{-- Banking Info --}}
    <div class="row m-2">
        <h5 class="text-primary w-100">Family Member Details</h5>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="name" id="name">
                @error('name')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="relation_with_emp" class="col-sm-2 col-form-label">Relation with employee</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="relation_with_emp" id="relation_with_emp">
                @error('relation_with_emp')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10 mb-4">
                <textarea class="form-control" name="address" id="address" cols="10" rows="3"></textarea>

                @error('address')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="area" class="col-sm-2 col-form-label">Village/Area</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="area" id="area">

                @error('area')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="country_id" id="country_id">
                    @foreach ($countries as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2 w-100" name="state_id" id="state_id" disabled>
                </select>
                @error('state_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">District</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2 w-100" name="district_id" id="district_id" disabled>
                </select>
                @error('district_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pincode" class="col-sm-2 col-form-label">Pincode</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="pincode" id="pincode">
                @error('pincode')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>


            <label for="account_number" class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="account_number" id="account_number">
                @error('account_number')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>



            <label class="col-sm-2 col-form-label">Whether Residing with him or Not</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="is_residing" id="is_residing">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('payment_mode_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="remark" class="col-sm-2 col-form-label">Remarks</label>
            <div class="col-sm-4 mb-4">
                <textarea class="form-control" name="remark" id="remark" cols="10" rows="3"></textarea>

                @error('remark')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <ul class="list-inline pull-right">
        <li><button type="button" class="default-btn prev-step">Back</button>
        </li>
        <li><button type="button" class="default-btn next-step skip-btn">Skip</button>
        </li>
        <li><button type="button" class="default-btn next-step">Continue</button>
        </li>
    </ul>
</div>
