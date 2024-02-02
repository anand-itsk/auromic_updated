<div class="tab-pane" role="tabpanel" id="step4">
    <h4 class="text-center pb-4">Nominee</h4>
    {{-- Banking Info --}}
    <div class="row m-2">
        <h5 class="text-primary w-100">Nominee Member Details</h5>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Select Family Member</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="family_memeber_id" id="family_memeber_id">
                    @foreach ($family_members as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('family_memeber_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="gratuity_sharing" class="col-sm-2 col-form-label">Proportion by which the gratuity will be
                shared</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="gratuity_sharing" name="gratuity_sharing" id="gratuity_sharing">
                @error('gratuity_sharing')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="maritalStatus" class="col-sm-2 col-form-label">Marital Status</label>
            <div class="col-sm-4 mb-4">
                <select name="maritalStatus" id="maritalStatus" class="form-control">
                    <option value="">Select</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                    <option value="other">Other</option>
                </select>
                @error('maritalStatus')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label class="col-sm-2 col-form-label">Religion</label>
            <div class="col-sm-4 mb-4">
                <select class="form-control select2" name="religion_id" id="religion_id">
                    @foreach ($religions as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                @error('religion_id')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="faorhus_name" class="col-sm-2 col-form-label">Father's/Husband
                Name</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="faorhus_name" id="faorhus_name">
                @error('faorhus_name')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="guardian_name" class="col-sm-2 col-form-label">Guardian Name</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="guardian_name" id="guardian_name">
                @error('guardian_name')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="guardian_address" class="col-sm-2 col-form-label">Guardian Address</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="guardian_address" id="guardian_address">
                @error('guardian_address')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <label for="guardian_relation_with_emp" class="col-sm-2 col-form-label">Guardian relation with employee</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" type="text" name="guardian_relation_with_emp" id="guardian_relation_with_emp">
                @error('guardian_relation_with_emp')
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
