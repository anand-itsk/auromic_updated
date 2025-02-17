$(document).ready(function() {
    $('#office_country_id').select2();

    $('#office_country_id').on('change', function() {
        var countryId = this.value;
        $.get(`/get-states/${countryId}`, function(states) {
            var stateSelect = $('#office_state_id');
            stateSelect.empty();
            stateSelect.append(new Option('Select State', ''));
            $.each(states, function(index, state) {
                stateSelect.append(new Option(state.name, state.id));
            });
            stateSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#office_state_id').select2();

    $('#office_state_id').on('change', function() {
        var stateId = this.value;
        $.get(`/get-districts/${stateId}`, function(districts) {
            var districtSelect = $('#office_district_id');
            districtSelect.empty();
            districtSelect.append(new Option('Select District', ''));
            $.each(districts, function(index, district) {
                districtSelect.append(new Option(district.name, district.id));
            });
            districtSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#country_id').select2();

    $('#country_id').on('change', function() {
        var countryId = this.value;
        $.get(`/get-states/${countryId}`, function(states) {
            var stateSelect = $('#state_id');
            stateSelect.empty();
            stateSelect.append(new Option('Select State', ''));
            $.each(states, function(index, state) {
                stateSelect.append(new Option(state.name, state.id));
            });
            stateSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#corrs_country_id').select2();

    $('#corrs_country_id').on('change', function() {
        var countryId = this.value;
        $.get(`/get-states/${countryId}`, function(states) {
            var stateSelect = $('#corrs_state_id');
            stateSelect.empty();
            stateSelect.append(new Option('Select State', ''));
            $.each(states, function(index, state) {
                stateSelect.append(new Option(state.name, state.id));
            });
            stateSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#corrs_state_id').select2();

    $('#corrs_state_id').on('change', function() {
        var stateId = this.value;
        $.get(`/get-districts/${stateId}`, function(districts) {
            var districtSelect = $('#corrs_district_id');
            districtSelect.empty();
            districtSelect.append(new Option('Select District', ''));
            $.each(districts, function(index, state) {
                districtSelect.append(new Option(state.name, state.id));
            });
            districtSelect.prop('disabled', false).trigger('change');
        });
    });

    

    // Similar logic for updating districts when state changes

    // Edit Fetch State
    let selectedOfficeCountryId = $('#office_country_id').val();
    if(selectedOfficeCountryId != 1) {
        $('#office_state_id').prop('disabled', false).trigger('change');
        loadOfficeStates(selectedOfficeCountryId, 'office_state_id', selectedOfficeStateId);
    }

    $('#office_country_id').on('change', function() {
        loadOfficeStates($(this).val(), 'office_state_id');
    });

    function loadOfficeStates(countryId, stateSelectId, selectedOfficeStateId = null) {
        $.ajax({
            url: '/get-states/' + countryId,
            type: 'GET',
            success: function (states) {

                $('#' + stateSelectId).empty().append('<option value="">Select State</option>');
                states.forEach(function (state) {
                    let isSelected = selectedOfficeStateId == state.id ? 'selected' : '';
                    $('#' + stateSelectId).append('<option value="' + state.id + '" ' + isSelected + '>' + state.name + '</option>');
                });
                $('#' + stateSelectId).trigger('change'); // Notify select2 to update options
            }
        });
    }

        // Edit Fetch District
        let selectedOfficeStateIdNew = $('#office_state_id').val();
        if(selectedOfficeStateIdNew != 1) {
            $('#office_district_id').prop('disabled', false).trigger('change');
            loadOfficeDistricts(selectedOfficeStateIdNew, 'office_district_id', selectedOfficeDistrictId);
        }
    
        $('#office_state_id').on('change', function() {
            loadOfficeDistricts($(this).val(), 'office_district_id');
        });
        
        function loadOfficeDistricts(stateId, districtSelectId, selectedOfficeDistrictId1 = null) {
            

            $.ajax({
                url: '/get-districts/' + stateId,
                type: 'GET',
                success: function (districts) {

                    $('#' + districtSelectId).empty().append('<option value="">Select District</option>');

                    districts.forEach(function (district) {
                        let isSelectedDistrict = selectedOfficeDistrictId == district.id ? 'selected' : '';
                        $('#' + districtSelectId).append('<option value="' + district.id + '" ' + isSelectedDistrict + '>' + district.name + '</option>');
                    });
                    $('#' + districtSelectId).trigger('change'); // Notify select2 to update options
                }
            });
        }

    let selectedCountryId = $('#corrs_country_id').val();
    if(selectedCountryId != 1) {
        $('#corrs_state_id').prop('disabled', false).trigger('change');
        loadStates(selectedCountryId, 'corrs_state_id', selectedStateId);
    }

    $('#corrs_country_id').on('change', function() {
        loadStates($(this).val(), 'corrs_state_id');
    });

    function loadStates(countryId, stateSelectId, selectedStateId = null) {
        $.ajax({
            url: '/get-states/' + countryId,
            type: 'GET',
            success: function (states) {

                $('#' + stateSelectId).empty().append('<option value="">Select State</option>');
                states.forEach(function (state) {
                    let isSelected = selectedStateId == state.id ? 'selected' : '';
                    $('#' + stateSelectId).append('<option value="' + state.id + '" ' + isSelected + '>' + state.name + '</option>');
                });
                $('#' + stateSelectId).trigger('change'); // Notify select2 to update options
            }
        });
    }


});