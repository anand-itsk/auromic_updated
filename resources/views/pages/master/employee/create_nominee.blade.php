<div class="tab-pane" role="tabpanel" id="step4">
    <h4 class="text-center pb-4">Nominee</h4>
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn icon-button btn-primary" data-toggle="modal" data-target=".employee-nominee-add"
            title="Add Nominee Member" id="addNomineeButton"><i class="fa fa-user-plus"></i></button>
    </div>
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
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Add Nominee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body py-0">
                                    <form role="form"
                                        action="{{ route('master.employees.store.nominee', $employee->id) }}"
                                        method="post" class="login-box">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label mandatory">Select Family Member</label>
                                            <div class="col-sm-4 mb-4">
                                               <select class="form-control select2" name="family_member_id" id="family_member_id">
        <option value="">Select</option>
        <!-- Options will be populated by AJAX -->
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

                                            <label for="marital_status" class="col-sm-2 col-form-label">Marital
                                                Status</label>
                                            <div class="col-sm-4 mb-4">
                                                <select name="marital_status" id="marital_status" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="divorced">Divorced</option>
                                                    <option value="widowed">Widowed</option>
                                                    <option value="separated">Separated</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                @error('marital_status')
                                                    <span class="error" style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <label class="col-sm-2 col-form-label">Religion
                                                <a class="shortcut_master"
                                                href="{{ route('common.religions.create') }}" target="_blank">+</a>
                                            </label>
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

                                            <li><button type="button"
                                                    class="default-btn next-step4 m-0 bg-primary rounded text-white"
                                                    data-url="{{ route('master.employees.store.nominee', $employee->id)}}">Add</button>
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
    {{-- <ul class="list-inline pull-right">
        <li><button type="button" class="default-btn next-step"
                data-url="{{ route('master.employees.show', $employee->id) }}">Preview</button>
        </li>
    </ul> --}}
    <script>
        $(".next-step4").click(function(e) {
            console.log("click")
            e.preventDefault();
 console.log($('meta[name="csrf-token"]').attr('content'));
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
                    nomineeTable(response
                        .emp_id);
                    console.log(response.family_members);
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
                    console.log(response);
                    var tableBody = $('#nomineeTableBody');
                    tableBody.html('');
                    var nominees = response.nominee; // Assuming this is the array of nominee details
                    console.log(nominees);
                    if (nominees.length > 0) {
                        console.log("inside Length")
                        nominees.forEach(function(item, index) {
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
                    console.log(data);
                    $('#family_member_id').val(data.family_member_id);
                    $('#gratuity_sharing').val(data.gratuity_sharing);
                    $('#marital_status').val(data.marital_status);
                    $('#faorhus_name').val(data.faorhus_name);
                    $('#guardian_name').val(data.guardian_name);
                    $('#guardian_address').val(data.guardian_address);
                    $('#guardian_relation_with_emp').val(data.guardian_relation_with_emp);
                    $('#religion_id').val(data.religion_id);

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
                    type: 'get',
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

<script>
$(document).ready(function() {
    // Replace with the actual employee ID
    var employeeId = {{ $employee_id }};

    $('#addNomineeButton').on('click', function() {
        $.ajax({
            url: '/master/employees/employee/' + employeeId + '/family-members',
            type: 'GET',
            success: function(data) {
                var familyMemberSelect = $('#family_member_id');
                familyMemberSelect.empty();
                familyMemberSelect.append('<option value="">Select</option>');
                $.each(data, function(index, item) {
                    familyMemberSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            }
        });
    });
});
</script>

<script>
    document.querySelector('.next-step4').addEventListener('click', function(e) {
    let valid = true;

    // Family member validation
    const familyMemberSelect = document.getElementById('family_member_id');
    const familyMemberError = document.querySelector('#family_member_id + .error');
    
    if (familyMemberSelect.value === '') {
        valid = false;
        if (!familyMemberError) {
            // Create and display an error message if not already present
            const errorMessage = document.createElement('span');
            errorMessage.className = 'error';
            errorMessage.style.color = 'red';
            errorMessage.textContent = 'Family member selection is required';
            familyMemberSelect.parentElement.appendChild(errorMessage);
        }
    } else {
        // Remove any previous error message if the selection is valid
        if (familyMemberError) {
            familyMemberError.textContent = '';
        }
    }

    if (!valid) {
        e.preventDefault(); // Prevent further action if validation fails
    } else {
        alert('Form is valid. Proceeding...');
        // Optionally, you can proceed with form submission or further AJAX handling
    }
});

</script>
</div>
