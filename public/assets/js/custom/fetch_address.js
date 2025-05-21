$(document).ready(function () {
    $('#office_country_id').select2();

    $('.office_country_id').on('change', function () {
        var countryId = this.value;
        $.get(`/get-states/${countryId}`, function (states) {
            console.log('states..',states);
            
            var stateSelect = $('.office_state_id');

            if (stateSelect) {
                // alert('in');
                stateSelect.prop('disabled', false).trigger('change');
            }

            stateSelect.empty();
            stateSelect.append(new Option('Select State', ''));
            $.each(states, function (index, state) {
                stateSelect.append(new Option(state.name, state.id));
            });
        });
    });

    $('#office_state_id').select2();

    $('.office_state_id').on('change', function () {
        var stateId = this.value;
        $.get(`/get-districts/${stateId}`, function (districts) {
            var districtSelect = $('#office_district_id');
            districtSelect.empty();
            districtSelect.append(new Option('Select District', ''));
            $.each(districts, function (index, district) {
                districtSelect.append(new Option(district.name, district.id));
            });
            districtSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#country_id').select2();

    $('#country_id').on('change', function () {
        var countryId = this.value;
        $.get(`/get-states/${countryId}`, function (states) {
            var stateSelect = $('#state_id');
            stateSelect.empty();
            stateSelect.append(new Option('Select State', ''));
            $.each(states, function (index, state) {
                stateSelect.append(new Option(state.name, state.id));
            });
            stateSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#corrs_country_id').select2();

    $('#corrs_country_id').on('change', function () {
        var countryId = this.value;
        $.get(`/get-states/${countryId}`, function (states) {
            var stateSelect = $('#corrs_state_id');
            stateSelect.empty();
            stateSelect.append(new Option('Select State', ''));
            $.each(states, function (index, state) {
                stateSelect.append(new Option(state.name, state.id));
            });
            stateSelect.prop('disabled', false).trigger('change');
        });
    });

    $('#corrs_state_id').select2();

    $('#corrs_state_id').on('change', function () {
        var stateId = this.value;
        $.get(`/get-districts/${stateId}`, function (districts) {
            var districtSelect = $('#corrs_district_id');
            districtSelect.empty();
            districtSelect.append(new Option('Select District', ''));
            $.each(districts, function (index, state) {
                districtSelect.append(new Option(state.name, state.id));
            });
            districtSelect.prop('disabled', false).trigger('change');
        });
    });

    

});