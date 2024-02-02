<div class="tab-pane" role="tabpanel" id="step2">
    <h4 class="text-center pb-4">Finance</h4>
    {{-- Banking Info --}}
    <div class="row m-2">
        <h5 class="text-primary w-100">Banking Info</h5>
        <div class="form-group row">
            <label for="bank_name" class="col-sm-2 col-form-label">Bank Name</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="bank_name" id="bank_name">
                @error('bank_name')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="account_number" class="col-sm-2 col-form-label">Salary A/C No</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="account_number" id="account_number">
                @error('account_number')
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

            <label class="col-sm-2 col-form-label">Payment Mode</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="payment_mode_id" id="payment_mode_id">
                    @foreach ($payment_modes as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('payment_mode_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">A/C Type</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="account_type" id="account_type">
                    <option value="">Select</option>
                    <option value="checking">Checking</option>
                    <option value="savings">Savings</option>
                    <option value="moneyMarket">Money Market</option>
                    <option value="certificateOfDeposit">Certificate of Deposit (CD)</option>
                    <option value="businessChecking">Business Checking</option>
                    <option value="businessSavings">Business Savings</option>
                    <option value="individualRetirement">Individual Retirement Account (IRA)</option>
                    <option value="other">Other</option>
                </select>
                @error('account_type')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="bank_ref_no" class="col-sm-2 col-form-label">Bank Ref.no</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="bank_ref_no" id="bank_ref_no">
                @error('bank_ref_no')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="range" class="col-sm-2 col-form-label">Ward/ Circle/ Range</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="range" id="range">
                @error('range')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    {{-- LIC Info --}}
    <div class="row m-2">
        <h5 class="text-primary w-100">LIC Info</h5>

        <div class="form-group row">
            <label for="policy_no" class="col-sm-2 col-form-label">Pincode</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="policy_no" id="policy_no">
                @error('policy_no')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="policy_term" class="col-sm-2 col-form-label">Policy Term</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="policy_term" id="policy_term">
                @error('policy_term')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="lic_id" class="col-sm-2 col-form-label">LIC ID</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="lic_id" id="lic_id">
                @error('lic_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="annual_renewable_date" class="col-sm-2 col-form-label">Annual Renewable Date</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="annual_renewable_date" id="annual_renewable_date">
                @error('annual_renewable_date')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    {{-- PF Info --}}
    <div class="row m-2">
        <h5 class="text-primary w-100">PF Info</h5>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">PF Applicable</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control" name="pf_applicable" id="pf_applicable">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                @error('pf_applicable')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pf_no" class="col-sm-2 col-form-label">PF No</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="pf_no" id="pf_no">
                @error('pf_no')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pf_joining_date" class="col-sm-2 col-form-label">PF Joining Date</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="pf_joining_date" id="pf_joining_date">
                @error('pf_joining_date')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pf_last_date" class="col-sm-2 col-form-label">PF Last Date</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="pf_last_date" id="pf_last_date">
                @error('pf_last_date')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">Pension Applicable</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control" name="pension_applicable" id="pension_applicable">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                @error('pension_applicable')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pension_joining_date" class="col-sm-2 col-form-label">Pension Joining Date</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="pension_joining_date" id="pension_joining_date">
                @error('pension_joining_date')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    {{-- ESI Info --}}
    <div class="row m-2">
        <h5 class="text-primary w-100">ESI Info</h5>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ESI Applicable</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control" name="esi_applicable" id="esi_applicable">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                @error('esi_applicable')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pf_no" class="col-sm-2 col-form-label">ESI No</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="esi_no" id="esi_no">
                @error('esi_no')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pf_joining_date" class="col-sm-2 col-form-label">ESI Joining Date</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="esi_joining_date" id="esi_joining_date">
                @error('esi_joining_date')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="pf_last_date" class="col-sm-2 col-form-label">ESI Last Date</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="date" name="esi_last_date" id="esi_last_date">
                @error('esi_last_date')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">Local Office</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="local_office_id" id="local_office_id">
                    @foreach ($local_offices as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('local_office_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">ESI Dispensary</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="esi_dispensary_id" id="esi_dispensary_id">
                    @foreach ($esi_despensaries as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('esi_dispensary_id')
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
