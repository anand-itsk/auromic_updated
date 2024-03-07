<div class="tab-pane" role="tabpanel" id="step2">
    <h4 class="text-center m-0">Finance</h4>
    <form role="form" action="{{ route('master.employees.store.finance', $employee->id) }}" method="post"
        class="login-box">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- Banking Info --}}
        <div class="row m-2">
            <h5 class="text-primary w-100 mt-0">Banking Info</h5>
            <div class="form-group row">
                <label for="bank_name" class="col-sm-2 col-form-label">Bank Name</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text" name="bank_name" id="bank_name"
                        value={{ $employee->financeDetail ? $employee->financeDetail->bank_name : '' }}>
                    @error('bank_name')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="account_number" class="col-sm-2 col-form-label">Salary A/C No</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text" name="account_number" id="account_number"
                        value={{ $employee->financeDetail ? $employee->financeDetail->account_number : '' }}>
                    @error('account_number')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-4 mb-4">
                    <textarea class="form-control" name="address" id="address" cols="10" rows="3"> {{ $employee->financeDetail ? $employee->financeDetail->address : '' }}</textarea>

                    @error('address')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label class="col-sm-2 col-form-label">Payment Mode</label>
                <div class="col-sm-4 mb-4">
                    <select class="form-control select2" name="payment_mode_id" id="payment_mode_id">
                        @foreach ($payment_modes as $item)
                            <option value="{{ $item->id }}"
                                {{ $employee->financeDetail && $employee->financeDetail->payment_mode_id == $item->id ? 'selected' : '' }}>
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
                        <option value=""
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == null ? 'selected' : '' }}>
                            Select</option>
                        <option value="checking"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'checking' ? 'selected' : '' }}>
                            Checking
                        </option>
                        <option value="savings"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'savings' ? 'selected' : '' }}>
                            Savings
                        </option>
                        <option value="moneyMarket"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'moneyMarket' ? 'selected' : '' }}>
                            Money
                            Market</option>
                        <option value="certificateOfDeposit"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'certificateOfDeposit' ? 'selected' : '' }}>
                            Certificate of Deposit (CD)</option>
                        <option value="businessChecking"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'businessChecking' ? 'selected' : '' }}>
                            Business Checking</option>
                        <option value="businessSavings"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'businessSavings' ? 'selected' : '' }}>
                            Business Savings</option>
                        <option value="individualRetirement"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'individualRetirement' ? 'selected' : '' }}>
                            Individual Retirement Account (IRA)</option>
                        <option value="other"
                            {{ $employee->financeDetail && $employee->financeDetail->account_type == 'other' ? 'selected' : '' }}>
                            Other</option>
                    </select>
                    @error('account_type')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="bank_ref_no" class="col-sm-2 col-form-label">Bank Ref.no</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text" name="bank_ref_no" id="bank_ref_no"
                        value={{ $employee->financeDetail ? $employee->financeDetail->bank_ref_no : '' }}>
                    @error('bank_ref_no')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="range" class="col-sm-2 col-form-label">Ward/ Circle/ Range</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="range" id="range"
                        value={{ $employee->financeDetail ? $employee->financeDetail->range : '' }}>
                    @error('range')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>

        <hr />
        {{-- LIC Info --}}
        <div class="row m-2">
            <h5 class="text-primary w-100 mt-0">LIC Info</h5>

            <div class="form-group row">
                <label for="policy_no" class="col-sm-2 col-form-label">Policy No</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text" name="policy_no" id="policy_no"
                        value= "{{ $employee->licInfo ? $employee->licInfo->policy_no : '' }}">
                    @error('policy_no')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="policy_term" class="col-sm-2 col-form-label">Policy Term</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text" name="policy_term" id="policy_term"
                        value= "{{ $employee->licInfo ? $employee->licInfo->policy_term : '' }}">
                    @error('policy_term')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="lic_id" class="col-sm-2 col-form-label">LIC ID</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="lic_id" id="lic_id"
                        value= "{{ $employee->licInfo ? $employee->licInfo->lic_id : '' }}">
                    @error('lic_id')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="annual_renewable_date" class="col-sm-2 col-form-label">Annual Renewable Date</label>
                <div class="col-sm-4">
                    <input class="form-control" type="date"
                        value= "{{ $employee->licInfo ? $employee->licInfo->annual_renewable_date : '' }}"
                        name="annual_renewable_date" id="annual_renewable_date">
                    @error('annual_renewable_date')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <hr />
        {{-- PF Info --}}
        <div class="row m-2">
            <h5 class="text-primary w-100 mt-0">PF Info</h5>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">PF Applicable</label>
                <div class="col-sm-4 mb-4">
                    <select class="form-control" name="pf_applicable" id="pf_applicable">
                        <option value=""
                            {{ $employee->pfInfo && $employee->pfInfo->pf_applicable == null ? 'selected' : '' }}>
                            Select
                        </option>
                        <option value="1"
                            {{ $employee->pfInfo && $employee->pfInfo->pf_applicable == '1' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="0"
                            {{ $employee->pfInfo && $employee->pfInfo->pf_applicable == '0' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('pf_applicable')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="pf_no" class="col-sm-2 col-form-label">PF No</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text"
                        value="{{ $employee->pfInfo ? $employee->pfInfo->pf_no : '' }}" name="pf_no"
                        id="pf_no">
                    @error('pf_no')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
<label for="pf_joining_date" class="col-sm-2 col-form-label">PF Joining Date</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="date" value="{{ $employee->pfInfo->pf_joining_date ?? '' }}" name="pf_joining_date" id="pf_joining_date">
    @error('pf_joining_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="pf_last_date" class="col-sm-2 col-form-label">PF Last Date</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="date" value="{{ $employee->pfInfo->pf_last_date ?? '' }}" name="pf_last_date" id="pf_last_date">
    @error('pf_last_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                <label class="col-sm-2 col-form-label">Pension Applicable</label>
                <div class="col-sm-4">
                    <select class="form-control" name="pension_applicable" id="pension_applicable">
                        <option value=""
                            {{ $employee->pfInfo && $employee->pfInfo->pension_applicable == null ? 'selected' : '' }}>
                            Select</option>
                        <option value="1"
                            {{ $employee->pfInfo && $employee->pfInfo->pension_applicable == '1' ? 'selected' : '' }}>
                            Yes</option>
                        <option value="0"
                            {{ $employee->pfInfo && $employee->pfInfo->pension_applicable == '0' ? 'selected' : '' }}>
                            No
                        </option>
                    </select>
                    @error('pension_applicable')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="pension_joining_date" class="col-sm-2 col-form-label">Pension Joining Date</label>
                <div class="col-sm-4">
                    <input class="form-control" type="date"
                        value="{{ $employee->pfInfo->pension_joining_date ?? '' }}" name="pension_joining_date"
                        id="pension_joining_date">
                    @error('pension_joining_date')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <hr />
        {{-- ESI Info --}}
        <div class="row m-2">
            <h5 class="text-primary w-100 mt-0">ESI Info</h5>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ESI Applicable</label>
                <div class="col-sm-4 mb-4">
                    <select class="form-control" name="esi_applicable" id="esi_applicable">
                        <option value=""
                            {{ $employee->esiInfo && $employee->esiInfo->esi_applicable == null ? 'selected' : '' }}>
                            Select</option>
                        <option value="1"
                            {{ $employee->esiInfo && $employee->esiInfo->esi_applicable == '1' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="0"
                            {{ $employee->esiInfo && $employee->esiInfo->esi_applicable == '0' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('esi_applicable')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="pf_no" class="col-sm-2 col-form-label">ESI No</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="text"
                        value="{{ $employee->esiInfo ? $employee->esiInfo->esi_no : '' }}" name="esi_no"
                        id="esi_no">
                    @error('esi_no')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="pf_joining_date" class="col-sm-2 col-form-label">ESI Joining Date</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="date"
                        value="{{ $employee->esiInfo ? $employee->esiInfo->esi_joining_date : '' }}"
                        name="esi_joining_date" id="esi_joining_date">
                    @error('esi_joining_date')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label for="pf_last_date" class="col-sm-2 col-form-label">ESI Last Date</label>
                <div class="col-sm-4 mb-4">
                    <input class="form-control" type="date"
                        value="{{ $employee->esiInfo ? $employee->esiInfo->esi_last_date : '' }}"
                        name="esi_last_date" id="esi_last_date">
                    @error('esi_last_date')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label class="col-sm-2 col-form-label">Local Office</label>
                <div class="col-sm-4">
                    <select class="form-control select2" name="local_office_id" id="local_office_id">
                        @foreach ($local_offices as $item)
                            <option value="{{ $item->id }}"
                                {{ $employee->esiInfo && $employee->esiInfo->local_office_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('local_office_id')
                        <span class="error" style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <label class="col-sm-2 col-form-label">ESI Dispensary</label>
                <div class="col-sm-4">
                    <select class="form-control select2" name="esi_dispensary_id" id="esi_dispensary_id">
                        @foreach ($esi_despensaries as $item)
                            <option value="{{ $item->id }}"
                                {{ $employee->esiInfo && $employee->esiInfo->esi_dispensary_id == $item->id ? 'selected' : '' }}>
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

        <ul class="list-inline pull-right mt-0">
            <li><button type="button" class="default-btn prev-step m-0">Back</button>
            </li>
            <li><button type="button" class="default-btn next-step skip-btn m-0">Skip</button>
            </li>
            <li><button type="button" class="default-btn next-step2 m-0"
                    data-url="{{ route('master.employees.store.finance', $employee->id) }}">Continue</button>
            </li>
        </ul>
    </form>

    <script>
        $(".next-step2").click(function(e) {
            e.preventDefault();

            var activeTab = $('.wizard .nav-tabs li.active');
            var form = $(this).closest('form');
            var formData = new FormData(form[0]);
            var url = form.attr('action'); // Set form action attribute to the appropriate Laravel route.
            console.log(url);
            // AJAX submission to Laravel
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // If save is successful, move to the next tab
                    activeTab.next().removeClass('disabled');
                    nextTab(activeTab);
                },
                error: function(response) {
                    if (response.status === 422) { // Unprocessable Entity (Validation Error)
                        let errors = response.responseJSON.errors;
                        let firstInvalidInput = null;

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let inputField = form.find('[name="' + key + '"]');
                                let errorMessage = errors[key][0]; // First error message for this field

                                // Append error message and add invalid input styling
                                inputField.addClass('is-invalid').after(
                                    '<span class="error-message text-danger">' + errorMessage +
                                    '</span>');

                                // Focus the first invalid input
                                if (!firstInvalidInput) {
                                    firstInvalidInput = inputField;
                                }
                            }
                        }

                        if (firstInvalidInput) {
                            firstInvalidInput.focus();
                        }
                    } else {
                        // Handle other types of errors
                        console.log('An error occurred:', response.statusText);
                    }
                }
            });
        });
    </script>
    
<script>
    // Get references to the date input fields
    var joiningDateInput = document.getElementById('pf_joining_date');
    var lastDateInput = document.getElementById('pf_last_date');

    // Add event listener to the joining date input field
    joiningDateInput.addEventListener('change', function() {
        // Get the selected date in the joining date field
        var selectedDate = new Date(joiningDateInput.value);
        // Set the minimum selectable date in the last date field to one day after the selected date
        var minSelectableDate = new Date(selectedDate.getTime() + 24 * 60 * 60 * 1000);
        lastDateInput.min = minSelectableDate.toISOString().split('T')[0];
    });
</script>

<script>
    // Get references to the date input fields
    var joiningDateInput = document.getElementById('esi_joining_date');
    var lastDateInput = document.getElementById('esi_last_date');

    // Add event listener to the joining date input field
    joiningDateInput.addEventListener('change', function() {
        // Get the selected date in the joining date field
        var selectedDate = new Date(joiningDateInput.value);
        // Set the minimum selectable date in the last date field to one day after the selected date
        var minSelectableDate = new Date(selectedDate.getTime() + 24 * 60 * 60 * 1000);
        lastDateInput.min = minSelectableDate.toISOString().split('T')[0];
    });
</script>


</div>
