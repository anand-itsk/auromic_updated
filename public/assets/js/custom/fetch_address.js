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

    // Similar logic for updating districts when state changes


    let selectedCountryId = $('#office_country_id').val();
    if(selectedCountryId != 1) {
        $('#office_state_id').prop('disabled', false).trigger('change');
        loadStates(selectedCountryId, 'office_state_id', selectedStateId);
    }

    $('#office_country_id').on('change', function() {
        loadStates($(this).val(), 'office_state_id');
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