<div class="tab-pane" role="tabpanel" id="step4">
    <h4 class="text-center pb-4">Nominee</h4>
    <button type="button" class="default-btn icon-button btn-primary" data-toggle="modal"
        data-target=".employee-nominee-add" title="Add Famil Member"><i class="fa fa-user-plus"></i></button>
    <table class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gratuity Sharing</th>
                <th>Marital Status</th>
                <th>Guardian Name</th>
                <th>Guardian Relation With Emp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="nomineeTableBody">
        </tbody>
    </table>
    {{-- Banking Info --}}

    {{-- Add Nominee Member --}}
    <div class="modal fade employee-nominee-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Add Nominee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form role="form"
                                        action="{{ route('master.employees.store.nominee', $employee->id) }}"
                                        method="post" class="login-box">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Select Family Member</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="form-control select2" name="family_memeber_id"
                                                    id="family_memeber_id">
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

                                            <label for="gratuity_sharing" class="col-sm-2 col-form-label">Proportion by
                                                which the gratuity will be
                                                shared</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" type="gratuity_sharing"
                                                    name="gratuity_sharing" id="gratuity_sharing">
                                                @error('gratuity_sharing')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="maritalStatus" class="col-sm-2 col-form-label">Marital
                                                Status</label>
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
                                                <select class="form-control select2" name="religion_id"
                                                    id="religion_id">
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
                                                <input class="form-control" type="text" name="faorhus_name"
                                                    id="faorhus_name">
                                                @error('faorhus_name')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="guardian_name" class="col-sm-2 col-form-label">Guardian
                                                Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" type="text" name="guardian_name"
                                                    id="guardian_name">
                                                @error('guardian_name')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="guardian_address" class="col-sm-2 col-form-label">Guardian
                                                Address</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" type="text" name="guardian_address"
                                                    id="guardian_address">
                                                @error('guardian_address')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label for="guardian_relation_with_emp"
                                                class="col-sm-2 col-form-label">Guardian relation with employee</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" type="text"
                                                    name="guardian_relation_with_emp" id="guardian_relation_with_emp">
                                                @error('guardian_relation_with_emp')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="default-btn next-step3"
                                                    data-url="{{ route('master.employees.store.nominee', $employee->id) }}">Continue</button>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        $(".next-step3").click(function(e) {
            console.log("click")
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
                    $('.employee-nominee-add').modal('hide');
                    familyMemberTable(response
                        .emp_id);

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

        function nomineeTable(employeeId) {
            $.ajax({
                url: '{{ route('master.employees.nominee') }}',
                type: 'GET',
                data: {
                    employee_id: employeeId
                },
                success: function(response) {
                    console.log(response)
                    var tableBody = $('#nomineeTableBody');
                    tableBody.html('');
                    if (response.length > 0) {
                        response.forEach(function(item, index) {
                            var residing = item.is_residing ? 'Yes' : 'No';
                            var row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.family_member.name}</td>
                        <td>${item.gratuity_sharing}</td>
                        <td>${item.marital_status}</td>
                        <td>${item.guardian_name}</td>
                        <td>${item.guardian_relation_with_emp}</td>
                        <td>
                        <button class="default-btn btn-primary" onclick="editNominee(${item.id})">Edit</button>
                        <button class="default-btn btn-danger" onclick="deleteNominee(${item.id})">Delete</button>
                        </td>
                    </tr>`;


                            tableBody.append(row);
                        });
                    } else {
                        tableBody.html('<tr><td colspan="7" class="text-center">Data not found</td></tr>');
                    }
                },
                error: function() {
                    $('#nomineeTableBody').html(
                        '<tr><td colspan="7" class="text-center">Error loading data</td></tr>');
                }
            });
        }

        function editNominee(id) {
            $.ajax({
                url: `/master/employees/nominee/edit/${id}`,
                type: 'GET',
                success: function(data) {
                    // Populate modal fields with fetched data
                    $('#name').val(data.name);
                    $('#relation_with_emp').val(data.relation_with_emp);
                    console.log();
                    $('#family_address').html(data.addresses[0].address);
                    $('#family_area').val(data.addresses[0].village_area);
                    $('#family_country_id').val(data.addresses[0].country_id);
                    $('#family_state_id').val(data.addresses[0].state_id);
                    $('#family_pincode').val(data.addresses[0].pincode);

                    $('#dob').val(data.dob);
                    $('#is_residing').val(data.is_residing);
                    $('#remark').html(data.remark);

                    // Continue for each field...

                    // Update form action for edit
                    $('.login-box').attr('action', `/master/employees/nominee/update/${id}`);

                    // Show the modal
                    $('.employee-nominee-add').modal('show');
                },
                error: function(error) {
                    console.log(error);
                    alert('Could not fetch the data.');
                }
            });
        }

        function deleteNominee(id, employeeId) {
            if (confirm('Are you sure you want to delete this Nominee?')) {
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },
                    url: `/master/employees/nominee/delete/${id}`,
                    type: 'DELETE',
                    success: function(result) {
                        alert(result.success);
                        console.log(result.emp_id);
                        // Remove the row from the table or refresh the table
                        nomineeTable(result
                            .emp_id); // Assuming this is your function to load family members
                    },
                    error: function(error) {
                        alert('Error deleting nominee');
                    }
                });
            }
        }
    </script>
</div>
