 {{-- Ajax store function --}}
 <script>
     $(document).ready(function() {
         // Function to clear form inputs
         function clearForm(formId) {
             $('#' + formId)[0].reset();
         }

         // Raw Material
         $('#saveRawMaterial').on('click', function() {
             let formData = $('#rawmaterialForm').serialize();
             console.log('formData----------', formData);


             let typeId = $('.raw_material_type_id').val();
             let name = $('.raw_material_name').val();
             let stock = $('.raw_material_stock').val();
             $.ajax({
                 url: "{{ route('product-models.raw_materials.store') }}",
                 type: "POST",
                 data: {
                     raw_material_type_id: typeId,
                     name: name,
                     stock: stock,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {
                         alert(response.message);

                         $('.raw_material').modal('hide');
                         // Append the new product to the dropdown using the 'data' key
                         $('#raw_material_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );


                         clearForm('rawmaterialForm');
                         $('#raw_material').modal('hide');

                     } else {
                         alert('Failed to add Product.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product.');
                 }
             });
         });

         //  Product 
         $('#saveProduct').on('click', function() {
             let formData = $('#productForm').serialize();
             $.ajax({
                 url: "{{ route('product-models.products.store') }}",
                 type: "POST",
                 data: formData,
                 success: function(response) {
                     if (response.success) {
                         alert(response.message);

                         // Append the new product to the dropdown using the 'data' key
                         $('.products').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );


                         clearForm('productForm');
                         $('#product').modal('hide');

                     } else {
                         alert('Failed to add Product.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product.');
                 }
             });
         });

         // Product  Size 
         $('#saveProductSize').on('click', function() {
             let formData = $('#productsizeForm').serialize();
             $.ajax({
                 url: "{{ route('product-models.product_sizes.store') }}",
                 type: "POST",
                 data: formData,
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);

                         // Append the new product to the dropdown using the 'data' key
                         $('.product_size_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('productsizeForm');
                         $('#product_size').modal('hide');
                     } else {
                         alert('Failed to add Product Size.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Size.');
                 }
             });
         });

         // Product Color 
         $('#saveProductColor').on('click', function() {
             let formData = $('#productcolorForm').serialize();
             let name = $('.product_color_name').val();
             let code = $('.product_color_code').val();
             $.ajax({
                 url: "{{ route('product-models.product_colors.store') }}",
                 type: "POST",
                 data: {
                     name: name,
                     code: code,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.product_color').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.product_color_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('productcolorForm');

                     } else {
                         alert('Failed to add Product Color.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Color.');
                 }
             });
         });
         // product Model
         $('#saveProductModel').on('click', function() {
             let formData = $('#productmodelForm').serialize();
             let pm_raw_material_id = $('.pm_raw_material_id').val();
             let pm_products = $('.pm_products').val();
             let pm_product_size_id = $('.pm_product_size_id').val();
             let pm_model_code = $('.pm_model_code').val();
             let pm_model_name = $('.pm_model_name').val();
             let pm_raw_material_weight_item = $('.pm_raw_material_weight_item').val();
             let pm_wages_product = $('.pm_wages_product').val();
             let pm_date = $('.pm_date').val();
             $.ajax({
                 url: "{{ route('master.product_model.store') }}",
                 type: "POST",
                 data: {
                     raw_material_id: pm_raw_material_id,
                     product_id: pm_products,
                     date: pm_date,
                     product_size_id: pm_product_size_id,
                     model_code: pm_model_code,
                     model_name: pm_model_name,
                     raw_material_weight_item: pm_raw_material_weight_item,
                     wages_product: pm_wages_product,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.product_model').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.product_model').append(
                             `<option value="${response.data.id}" selected>${response.data.model_code}/${response.data.model_name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('productmodelForm');

                     } else {
                         alert('Failed to add Product Model.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Model.');
                 }
             });
         });

         // Religion
         $('#saveReligion').on('click', function() {
             let formData = $('#religionForm').serialize();
             let religion_name = $('.religion_name').val();
             let religion_code = $('.religion_code').val();
             $.ajax({
                 url: "{{ route('common.religions.store') }}",
                 type: "POST",
                 data: {
                     name: religion_name,
                     code: religion_code,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.religion').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.religion_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('religionForm');

                     } else {
                         alert('Failed to add Religion.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Color.');
                 }
             });
         });


         //  Caste
         $('#saveCaste').on('click', function() {
             let formData = $('#casteForm').serialize();
             let caste_name = $('.caste_name').val();
             let caste_code = $('.caste_code').val();
             $.ajax({
                 url: "{{ route('common.castes.store') }}",
                 type: "POST",
                 data: {
                     name: caste_name,
                     code: caste_code,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.caste').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.caste_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('casteForm');

                     } else {
                         alert('Failed to add Caste.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Color.');
                 }
             });
         });

         // Nationality
         $('#saveNationality').on('click', function() {
             let formData = $('#nationalityForm').serialize();
             let nationality_name = $('.nationality_name').val();
             let nationality_code = $('.nationality_code').val();
             $.ajax({
                 url: "{{ route('common.nationalities.store') }}",
                 type: "POST",
                 data: {
                     name: nationality_name,
                     code: nationality_code,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.nationality').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.nationality_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('nationalityForm');

                     } else {
                         alert('Failed to add Caste.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Color.');
                 }
             });
         });

         // Resigning Reason
         $('#saveResigningReason').on('click', function() {
             let formData = $('#resigningreasonForm').serialize();
             let resigningreason_name = $('.resigningreason_name').val();
             let resigningreason_code = $('.resigningreason_code').val();
             $.ajax({
                 url: "{{ route('specified.resigning_reasons.store') }}",
                 type: "POST",
                 data: {
                     name: resigningreason_name,
                     code: resigningreason_code,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.resigning_reason').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.resigning_reason_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('resigningreasonForm');

                     } else {
                         alert('Failed to add Caste.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Color.');
                 }
             });
         });

         // ESI Dispensary
         $('#saveEsiDispensary').on('click', function() {
             let formData = $('#esidispensaryForm').serialize();
             let esidispensary_name = $('.esidispensary_name').val();
             let esidispensary_code = $('.esidispensary_code').val();
             $.ajax({
                 url: "{{ route('specified.esi_dispensaries.store') }}",
                 type: "POST",
                 data: {
                     name: esidispensary_name,
                     code: esidispensary_code,
                     ajax_mode: 'ajax',
                     _token: "{{ csrf_token() }}",
                 },
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.esi_dispensary').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.esi_dispensary_id').append(
                             `<option value="${response.data.id}" selected>${response.data.name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('esidispensaryForm');

                     } else {
                         alert('Failed to add Esi Dispensary.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Product Color.');
                 }
             });
         });


         // Customer
         $('#saveCustomer').on('click', function() {
             let formData = {
                 customer_code: $('.customer_code').val(),
                 customer_name: $('.customer_name').val(),
                 office_address: $('.customer_office_address').val(),
                 office_country_id: $('.customer_office_country_id').val(),
                 office_state_id: $('.customer_office_state_id').val(),
                 office_pincode: $('.customer_office_pincode').val(),
                 std_code: $('.customer_std_code').val(),
                 phone: $('.customer_phone').val(),
                 address: $('.customer_address').val(),
                 country_id: $('.customer_country_id').val(),
                 state_id: $('.customer_state_id').val(),
                 pincode: $('.customer_pincode').val(),
                 mobile: $('.customer_mobile').val(),
                 email: $('.customer_email').val(),
                 website: $('.customer_website').val(),
                 pan_no: $('.customer_pan_no').val(),
                 pan_date: $('.customer_pan_date').val(),
                 gst_no: $('.customer_gst_no').val(),
                 gst_date: $('.customer_gst_date').val(),
                 ajax_mode: 'ajax',
                 _token: "{{ csrf_token() }}"
             };
             $.ajax({
                 url: "{{ route('master.customers.store') }}",
                 type: "POST",
                 data: formData,
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                         'content') // Include the CSRF token
                 },
                 success: function(response) {
                     if (response.success) {

                         alert(response.message);
                         $('.customer').modal('hide');

                         // Append the new product to the dropdown using the 'data' key
                         $('.customer').append(
                             `<option value="${response.data.id}" selected>${response.data.customer_name}</option>`
                         );
                         // Append the new product size to the relevant UI element

                         clearForm('customerForm');

                     } else {
                         alert('Failed to add Customer.');
                     }
                 },
                 error: function(xhr) {
                     console.error(xhr.responseText);
                     alert('An error occurred while adding Customer.');
                 }
             });
         });




     });
 </script>
 {{-- End --}}


 {{-- Form  Start --}}
 <script>
     $('.submit-form').on('click', function() {
         $('#productModelForm').submit();
     })

     $('.submit-form').on('click', function() {
         $('#orderForm').submit();
     })

     $('.submit-form').on('click', function() {
         $('#orderAddForm').submit();
     })
     $('.submit-form').on('click', function() {
         $('#finishingProductForm').submit();
     })

     $('.submit-form').on('click', function() {
         $('#directJobGivingForm').submit();
     })
 </script>
 {{-- Form End --}}
