    <!-- Add Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/custom/fetch_address.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function showTextBox() {
            var selectBox = document.getElementById('business_nature');
            var textBox = document.getElementById('otherText');
            if (selectBox.value === 'Others') {
                textBox.style.display = 'block';
            } else {
                textBox.style.display = 'none';
            }
        }
    </script>
