<link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<x-app-layout>
    {{-- {{$all_data}} --}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-blue-400 w-full">
            <h2 class="text-lg-800">OPD Patients Billing</h2>
        </div>
        <table class="w-full text-sm text-left mt-1 text-gray-500 dark:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6">
                        SL no
                    </th>
                    <th scope="col" class="px-6" style="width:20%">
                        Patient Name
                    </th>
                    <th scope="col" class="px-6">
                        date
                    </th>
                    <th scope="col" class="px-6">
                        Billing
                    </th>
                    <th scope="col" class="px-6">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @php
                    $n = 0;
                @endphp
                @foreach ($list as $post)
                    @php
                        $bill_paid = $post->paid;
                        $fees = $post->fess;
                        $admission_type = $post->type;
                    @endphp
                    <tr>
                        <td class="px-6 py-4">
                            {{ $n = $n + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $post->patient_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $post->admission_date }}
                        </td>
                        <td class="px-6 py-4">
                            <button class="btn_addbill" data-modal-target="AddbillModal"
                                data-modal-toggle="AddbillModal"
                                value="{{ $post->aid }}"><x-buttons.blue>add Bill</x-buttons.blue></button>

                            <button class="btn_print" value="{{ $post->aid }}" data-modal-target="staticModal"
                                data-modal-toggle="staticModal"><x-buttons.green>view</x-buttons.green></button>

                            @if ($post->type == 'IPD')
                                <button data-modal-target="PayAdvModal" data-modal-toggle="PayAdvModal"
                                    class="btn_pay_advance" id="btn_pay_advance" value="{{ $post->aid }}">
                                    <x-buttons.dark>advance</x-buttons.dark>
                                </button>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($bill_paid < $fees && $post->discount + $post->paid < $fees)
                                <form action="{{ route('rec.paybills') }}" class="pt-3">
                                    @csrf
                                    <input type="hidden" name="btn_pay_adv" value="{{ $post->aid }}">
                                    <button class="btn_pay_bill" id="btn_pay_bill" value="{{ $post->aid }}">
                                        <x-buttons.red>payment</x-buttons.red>
                                    </button>
                                </form>
                            @endif

                            @if ($bill_paid == $fees || $post->discount + $post->paid == $fees)
                                <form action="{{ route('rec.d_patns') }}" method="GET" id="discharge_form_{{$post->aid}}" class="discharge_form pt-3"
                                    >
                                    @csrf
                                    <input type="hidden" name="d_patns" value="{{ $post->aid }}">
                                    <button class="discharge" name="discharge" id="discharge_{{ $post->aid }}"
                                        value="{{ $post->aid }}"><x-buttons.red>exit</x-buttons.red></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-5" style="margin: 10px !important"></div>
        {{ $list->links() }}
    </div>

    <div>
        <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full ">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Patient Invoice Deatils
                        </h3>
                        <button type="button"
                            class="close_popup  text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="staticModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6" id="printableContent">
                        <div class="patient">
                            <div class="bill_message uppercase my-1 text-center hidden text-xl font-bold text-red-900">
                            </div>
                            <div class="edit_bill_grid hidden">
                                <div class="grid grid-cols-3 gap-4 px-2 py-2  ">
                                    <div class="hidden">
                                        <input type="text" id="edt_aid" class="edt_aid">
                                    </div>
                                    <div>
                                        <x-label for="bill" value="{{ __('Description') }}" />
                                        <x-input id="edt_descr" class="block mt-1 bg-gray-200 w-full edt_descr"
                                            type="text" placeholder="Description" required disabled />
                                    </div>
                                    <div>
                                        <x-label for="bill" value="{{ __('Update Qty') }}" />
                                        <x-input id="edt_qty" class="block mt-1 w-full edt_qty" type="number"
                                            placeholder="quantity" required />
                                    </div>
                                    <div>
                                        <x-button class="bg-green-800 mt-8 btn_update_bill">Update</x-button>
                                        <x-button class="bg-red-800 mt-8 btn_cancel_update">Cancel</x-button>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <table class="w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="py-2 px-4 text-left">Description</th>
                                            <th class="py-2 px-4 text-left">Quantity</th>
                                            <th class="py-2 px-4 text-left">Unit Price</th>
                                            <th class="py-2 px-4 text-left">Total</th>
                                            <th class="py-2 px-4 text-left">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="final_print_table">

                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-semibold">Total Bill:
                                            </td>
                                            <td colspan="2" class="py-2 px-4 font-semibold total"></td>
                                        </tr>
                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-semibold">Discount:
                                            </td>
                                            <td colspan="2" class="py-2 px-4 font-semibold dis_amt"></td>
                                        </tr>
                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-semibold">Advance:
                                            </td>
                                            <td colspan="2" class="py-2 px-4 font-semibold adv_amt"></td>
                                        </tr>

                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-semibold">Paid Amount:
                                            </td>
                                            <td colspan="2" class="py-2 px-4 font-semibold paid"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="patient_details"></div>
                            <div class="grid grid-cols-3 gap-4 billing_details">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex  items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" id="confirm_print"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Print it</button>
                        {{-- <button data-modal-hide="staticModal" type="button"
                            style="background-color:#fce8e6;color:#a50e0e;border:1px solid #a50e0e"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div id="AddbillModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Patient Bill
                        </h3>
                        <button type="button"
                            class="text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="AddbillModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 pt_bill_modal" id="">
                        <div>
                            <div class="hidden">
                                <x-label for="bill" value="{{ __('Id') }}" />
                                <x-input id="a_id" class="block mt-1 w-full a_id" type="text" name="a_id"
                                    value="{{ old('a_id') }}" placeholder="Admission Id" required disabled />
                            </div>
                            <input type="text" value="this is " class="a_type hidden" id="a_type" disabled>
                            <div class="grid grid-cols-5 gap-3 p-5">
                                <div>
                                    <x-label for="bill" value="{{ __('Bill Description') }}" />
                                    <x-input id="b_descr" class="block mt-1 w-full b_descr" type="text"
                                        name="b_descr" value="{{ old('b_descr') }}" placeholder="Description"
                                        required />
                                </div>
                                <div>
                                    <x-label for="bill" value="{{ __('Amount') }}" />
                                    <x-input id="b_amt" class="block mt-1 w-full b_amt" type="text"
                                        name="b_amt" value="{{ old('b_amt') }}" placeholder="Amount" required />
                                </div>
                                <div>
                                    <x-label for="bill" value="{{ __('Quantity') }}" />
                                    <x-input id="b_qty" class="block mt-1 w-full b_qty" type="number"
                                        name="b_qty" value="{{ old('b_qty') }}" placeholder="Quantity"
                                        required />
                                </div>
                                <div>
                                    <x-label for="b_category" value="{{ __('Category') }}" />
                                    <x-select id="b_category" class="b_category ip_method_input" name="b_category"
                                        :title="'Category'" :options="['hospital' => 'Hospital', 'inj_iv' => 'IV Fluids & Injection']" />
                                </div>
                                <div class="mt-3">
                                    <x-button class="mt-4 bg-green-800 " id="btn_add_it">
                                        {{ __('Add') }}
                                    </x-button>
                                </div>
                            </div>

                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table
                                class="w-full border border-gray-300 text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-gray-700 border border-gray-300 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr class="border border-gray-300">
                                        <th scope="col" class="px-6">
                                            SL no
                                        </th>
                                        <th scope="col" class="px-6">
                                            Particulars
                                        </th>
                                        <th scope="col" class="px-6">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6">
                                            Amount
                                        </th>
                                        <th scope="col" class="px-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="add_bill_table border">


                                </tbody>
                                <tr class="border">
                                    <td colspan="4" class="text-right pr-6 py-4 font-semibold">Grand Total:</td>
                                    <td class="px-6 py-4 font-semibold bill_total"></td>
                                    <td></td>
                                </tr>
                                <tr class="border">
                                    <td colspan="2" class="text-left pl-2 py-4 font-semibold"> <x-button
                                            class="bg-red-800 " value="" id="btn_sub_tmp_bills">
                                            {{ __('Save Changes') }}
                                        </x-button></td>
                                    </td>
                                    <td colspan="4" class="px-6 py-4 font-semibold"></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    {{-- <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <x-button data-modal-hide="AddbillModal" type="button"
                            style="background-color:#fce8e6;color:#a50e0e;border:1px solid #a50e0e"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</x-button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div>
        <div id="PayAdvModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Advance Payment
                        </h3>
                        <button type="button" id="close_adv_model"
                            class="text-black close_adv_model bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="PayAdvModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 space-y-2 pt_bill_modal" id="">
                        <div>
                            <div class="hidden">
                                <x-label for="bill" value="{{ __('Id') }}" />
                                <x-input id="adv_a_id" class="block mt-1 w-full adv_a_id" type="text"
                                    placeholder="Admission Id" required disabled />
                            </div>
                            <div class="grid grid-cols-2 gap-3 p-2">
                                <div>
                                    <x-label for="bill" value="{{ __('Advance Amount') }}" />
                                    <x-input id="new_adv_amt" class="block mt-1 w-full new_adv_amt" type="number"
                                        placeholder="Enter Amount" required />
                                </div>
                                <div class="payment_mode">
                                    <x-label for="" value="{{ __('Payment Method') }}" />
                                    <x-select id="adv_p_method" class="adv_p_method" :title="'Select Payment Method'"
                                        :options="['cash' => 'CASH', 'upi' => 'UPI']" />
                                </div>

                                <div class="mt-3">
                                    <x-button class="mt-4 bg-green-800 btn_sub_adv_amt" id="btn_sub_adv_amt">
                                        {{ __('Pay Advance') }}
                                    </x-button>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="hidden">
        <div class="bills_content">
            <x-papers.bill_beforePrint />
        </div>
    </div>

    {{-- <textarea class="content" name="example" ></textarea> --}}


    <script src="{{ asset('js/jquery.richtext.min.js') }}"></script>

    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <script src="{{ asset('js/alert.js') }}"></script>

    <script>
        $(document).on('click', '.discharge', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to close this patient!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, close it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $('.discharge_form').submit();
                    $(this).closest('.discharge_form').submit();
                }
            });
        });
    </script>

    <script>
        $('.content').richText();

        $('#b_amt').on('input', function() {
            const input = $(this).val().replace(/\D/g, '').substring(0, 6); // Remove non-numeric characters
            // const formattedInput = input.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3'); // Add dashes
            $(this).val(input);
        });


        $(function() {
            // Function to fetch tags from the database
            function getTags(request, response) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('rec.get_services') }}', // Replace with your API or route URL
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            }

            // Initialize the autocomplete widget
            $("#b_descr").autocomplete({
                source: getTags // Use the getTags function as the source
            });
        });

        $(document).ready(function() {
            $("#b_descr").change(function(e) {
                e.preventDefault();
                var description = $(this).val();
                console.log(description);

                $.ajax({
                    type: "GET",
                    url: "{{ route('rec.get_ser_price') }}",
                    data: {
                        description: description
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $(".b_amt").val(response);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            all_patients_data = <?php echo $all_data; ?>;


            function fill_table(data_list) {
                var n = 0,
                    amount = 0;
                $.each(data_list, function(ind, val) {
                    amount = parseInt(amount) + parseInt(val.amount * val.qty);
                    $(".add_bill_table").append(`
                        <tr>
                            <td class="px-6 py-4">
                                        ${n = n + 1}
                                        </td>
                                        <td class="px-6 py-4">${val.description}</td>
                                        <td class="hidden admission_id">${val.admission_id}</td>
                                        <td class="px-6 py-4">${val.amount}</td>
                                        <td class="px-6 py-4">${val.qty}</td>
                                        <td class="px-6 py-4">${val.amount * val.qty}</td>
                                        <td class="px-6 py-4"> <x-button class="hover:bg-white bg-white delete_it" id="delete_it" value="${val.id}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ad0505}</style><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                    </x-button></td>
                                    </tr>
                                    <!-- More rows can be added here -->
                                   `);
                    $(".bill_total").html(amount);
                });
            }


            $(".btn_addbill").click(function(e) {
                e.preventDefault();
                var bill_id = $(this).val();
                $("#a_id").val(bill_id);
                $("#btn_sub_tmp_bills").val(bill_id);
                $('#b_descr').focus();

                $.ajax({
                    type: "GET",
                    url: "{{ route('rec.get_tmp_bills') }}",
                    data: {
                        admission_id: bill_id
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#a_type').val(response.type);
                        bills = response.temp_bills;
                        $('#b_descr').focus();
                        $(".add_bill_table").html("");
                        fill_table(bills);
                    }
                });
            });
            //Addition button pop-up data retrieve ends here


            //Addition of temproray bills starts here
            $("#btn_add_it").click(function(e) {
                e.preventDefault();
                var descr, b_amt, qty, a_id;
                a_id = $(".a_id").val();
                descr = $(".b_descr").val();
                b_amt = $(".b_amt").val();
                qty = $(".b_qty").val();
                cat = $(".b_category").val();
                admission_type = $('#a_type').val();
                if (descr != '' && b_amt != '' && qty != '' && cat != 'Category') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('rec.add_new_bill') }}",
                        data: {
                            admission_id: a_id,
                            description: descr,
                            admission_type: admission_type,
                            category: cat,
                            amount: b_amt,
                            qty: qty
                        },
                        dataType: "json",
                        success: function(response) {
                            var n = 0,
                                amount = 0,
                                total,
                                bills = response.bills;
                            $(".b_descr").val("");
                            $(".b_amt").val("");
                            $(".b_qty").val("");
                            $('#b_descr').focus();
                            $(".add_bill_table").html("");
                            fill_table(bills);
                        }
                    });
                } else {
                    Swal.fire('Invalid Bills');
                }
            });

            $("#btn_sub_tmp_bills").click(function(e) {
                e.preventDefault();
                var admission_id = $(this).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Save it !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        confirm_bill(admission_id);
                    }

                    function confirm_bill(admission_id) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('rec.confirm_bill') }}",
                            data: {
                                admission_id
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(response.msg, response.bills, response
                                    .check_bills);

                                if (response.check_bills) {
                                    $(".pt_bill_modal").html(
                                        "<h1>Bills are submitted successfully</h1>");
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    alert("There are no bills to submit")
                                }
                            }
                        });
                    }

                });
            });

            $(".btn_pay_advance").click(function(e) {
                e.preventDefault();
                id = $(this).val();
                $("#adv_a_id").val(id);
            });
            $(".close_adv_model").click(function(e) {
                e.preventDefault();
                $("#new_adv_amt").val('');
            });

            $("#btn_sub_adv_amt").click(function(e) {
                e.preventDefault();
                id = $("#adv_a_id").val();
                amount = $("#new_adv_amt").val();
                p_method = $(".adv_p_method").val();
                if (amount === '0' || amount === '' || p_method === 'Select Payment Method') {
                    Swal.fire('Invalid Payment Details');
                } else {
                    Swal.fire({
                        title: 'Confirm Payment?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Save it !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            pay_advance_amount(id, amount, p_method);
                        }

                        function pay_advance_amount(id, amount, p_method) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });
                            $.ajax({
                                type: "post",
                                url: "{{ route('rec.pay_adv_amt') }}",
                                data: {
                                    id: id,
                                    amount: amount,
                                    p_method: p_method
                                },
                                success: function(response) {
                                    if (response.msg ===
                                        'Advance Payment Success Full') {
                                        Swal.fire(response.msg);
                                        location.reload();
                                    }

                                }
                            });
                        }
                    });
                }

            });



            $(document).on('click', '.delete_it', function(e) {
                e.preventDefault();
                id = $(this).val();
                a_id = $(".admission_id").html();
                console.log(id, a_id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('rec.dlt_service') }}",
                    data: {
                        id: id,
                        a_id: a_id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        bills = response.bills;
                        if (response.msg == 'deleted') {
                            swal.fire("Deleted")
                            $(".add_bill_table").html("");
                            fill_table(bills);
                        }
                        if (response.msg == 'Unable to delete') {
                            swal.fire("Unable To Delete");
                        }

                    }
                });
            })

            //Generating the invoice to send for print
            $(".btn_print").click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                get_to_print(id);
                $("#confirm_print").val(id);

                function get_to_print(a_id) {
                    var id = a_id;
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.get_to_print') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            var p_data = response.patient_data;
                            adv_amt = p_data[0]['advance'];
                            fetched_aid = p_data[0]['aid']
                            $('.adv_amt').html(adv_amt);
                            // console.log(p_data);
                            $(".patient_details").html("");
                            var bill_data = response.bill;
                            fetched_bill_data(bill_data, fetched_aid);
                            // console.log(p_data, bill_data);
                            var amount = 0;

                            paid_in_words = response.paid_in_words
                            tot_amt = response.total_amt
                            dis_amt = response.dis_amount;
                            paid = response.paid
                            adv = response.advance
                            a_id = id

                            inj_iv_count = response.cat_count
                            p_data = response.patient_data;
                            fill_view_details(bill_data, p_data, paid_in_words, tot_amt,
                                dis_amt, paid, adv, a_id, inj_iv_count);


                        }
                    });
                }
            });

            function fill_view_details(bill_data, p_data, paid_in_words, tot_amt, dis_amt, paid, adv, a_id,
                inj_iv_count) {
                    console.log();
                $(".final_print_table").html("");
                if (bill_data != '') {
                    $.each(bill_data, function(ind, val) {
                        var amount = parseInt(amount) + parseInt(val.amount * val.qty);
                        paid = val.paid;
                        dis_amt = val.discount;
                        if(ind === 0 && val.admission_type === 'OPD'){
                            $(".final_print_table").append(`<tr>
                                            <td class="py-2 px-4">${val.description}</td>
                                            <td class="py-2 px-4">${val.qty}</td>
                                            <td class="py-2 px-4">${val.amount}</td>
                                            <td class="py-2 px-4">${val.amount * val.qty}</td>
                                            <td class="py-2 px-4">
                                                
                                            </td>
                                        </tr>`);
                        }
                        else{
                            $(".final_print_table").append(`<tr>
                                            <td class="py-2 px-4">${val.description}</td>
                                            <td class="py-2 px-4">${val.qty}</td>
                                            <td class="py-2 px-4">${val.amount}</td>
                                            <td class="py-2 px-4">${val.amount * val.qty}</td>
                                            <td class="py-2 px-4">
                                                <x-button class="btn_edit_bill" value="${val.id}">Edit</x-button>
                                                <x-button class="bg-red-800 btn_dlete_bill" value="${val.id}">Delete</x-button>
                                            </td>
                                        </tr>`);
                        }
            
                    });

                    $(".total").html(tot_amt);
                    $(".paid").html(paid);
                    $(".dis_amt").html(dis_amt);
                    $('.bill_message').addClass('hidden');
                } else {
                    $('.bill_message').removeClass('hidden');
                    $('.bill_message').html('No Bills Available');
                    $(".total").html('');
                    $(".paid").html('');
                    $(".dis_amt").html('');
                }

                $('.bill_table').html('');
                $.each(bill_data, function(ind, val) {
                    $('.bill_table').append(`<tr>                                      
                                        <td class="px-6 py-4">
                                            ${val.description}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${val.qty}
                                        </td>
                                        <td class="px-6 py-4"> 
                                            ${val.amount}                                          
                                        </td>
                                        <td class="px-6 py-4">
                                            ${val.total_amt}                                           
                                        </td>
                                    </tr>`);
                });
                $('.p_name').html(p_data[0]['name']);
                $('.p_admission').html(p_data[0]['created_at']);
                $('.p_address').html(p_data[0]['address']);
                $('.discharge_td').html('');

                $(".paid_in_words").html(paid_in_words);
                $(".tot_amt").html(tot_amt);
                $(".dis_amt").html(dis_amt);
                $(".rec_amt").html(paid);
                $('.adv_amt').html(adv);
                $('.p_regno').html(a_id);
                dis_text = $(".dis_amt").html();
                adv_amt = $('.adv_amt').html();
                if (dis_text === '') {
                    $('.dis_amt_sec').hide();
                } else {
                    $('.dis_amt_sec').show();
                }

                if(adv_amt === ''){
                    $('.adv_amt_sec').hide();
                }
                else{
                    $('.adv_amt_sec').show();
                }

                $(".edit_bill_grid").hide();
            }

            function fetched_bill_data(bill_data, a_id) {
                fetched_bill = bill_data;
                $('.edt_aid').val(a_id);
            }

            $(document).on('click', '.btn_edit_bill', function(e) {
                e.preventDefault();
                id = $(this).val();
                $(".edit_bill_grid").show();
                $.each(fetched_bill, function(ind, val) {
                    if (val.id == id) {
                        console.log(val.description);
                        $('.edt_bill_id').val(id);
                        $(".edt_descr").val(val.description);
                        $('.edt_qty').val(val.qty);
                        $(".btn_update_bill").val(id);
                    }
                });
            });

            $(document).on('click', '.btn_dlete_bill', function(e) {
                e.preventDefault();
                id = $(this).val();
                admission_id = $('.edt_aid').val();


                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to delete this bill!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        delete_bill(id, admission_id);
                    }
                });

                function delete_bill(id, admission_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('rec.dlt_bill') }}",
                        data: {
                            id: id,
                            admission_id: admission_id
                        },
                        success: function(response) {
                            var p_data = response.patient_data;
                            adv_amt = p_data[0]['advance'];
                            fetched_aid = p_data[0]['aid']
                            $('.adv_amt').html(adv_amt);
                            // console.log(p_data);
                            $(".patient_details").html("");
                            var bill_data = response.bill;
                            fetched_bill_data(bill_data, fetched_aid);
                            // console.log(p_data, bill_data);
                            var amount = 0;

                            paid_in_words = response.paid_in_words
                            tot_amt = response.total_amt
                            dis_amt = response.dis_amount;
                            paid = response.paid
                            adv = response.advance
                            a_id = id

                            inj_iv_count = response.cat_count
                            p_data = response.patient_data;

                            if (response.msg === 'success') {
                                Swal.fire('Delete Successfull');
                                fill_view_details(bill_data, p_data,
                                    paid_in_words, tot_amt,
                                    dis_amt, paid, adv, a_id, inj_iv_count);
                                // $('#edt_descr').val('');
                                // $('#edt_qty').val('');
                                // $(".edit_bill_grid").toggleClass('hidden block');

                            }
                        }
                    });
                }

            })


            $('.btn_update_bill').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                qty = $('.edt_qty').val();
                edt_aid = $('.edt_aid').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.edit_bill') }}",
                    data: {
                        id: id,
                        qty: qty,
                        a_id: edt_aid
                    },
                    success: function(response) {
                        var p_data = response.patient_data;
                        adv_amt = p_data[0]['advance'];
                        fetched_aid = p_data[0]['aid']
                        $('.adv_amt').html(adv_amt);
                        // console.log(p_data);
                        $(".patient_details").html("");
                        var bill_data = response.bill;
                        fetched_bill_data(bill_data, fetched_aid);
                        // console.log(p_data, bill_data);
                        var amount = 0;

                        paid_in_words = response.paid_in_words
                        tot_amt = response.total_amt
                        dis_amt = response.dis_amount;
                        paid = response.paid
                        adv = response.advance
                        a_id = id

                        inj_iv_count = response.cat_count
                        p_data = response.patient_data;

                        if (response.msg === 'success') {
                            Swal.fire('Bill Updated Successfull');
                            fill_view_details(bill_data, p_data, paid_in_words, tot_amt,
                                dis_amt, paid, adv, a_id, inj_iv_count);
                            $('#edt_descr').val('');
                            $('#edt_qty').val('');
                            $(".edit_bill_grid").toggleClass('hidden block');
                        }
                    }
                });
            });

            $(".btn_cancel_update").click(function(e) {
                e.preventDefault();
                $(".edit_bill_grid").hide();
                $('.edt_bill_id').val('');
                $(".edt_descr").val('');
                $('.edt_qty').val('');
                $(".btn_update_bill").val('');
            });

            $('.close_popup').click(function(e) {
                e.preventDefault();
                $(".edit_bill_grid").toggleClass('hidden block');
                $('.edt_bill_id').val('');
                $(".edt_descr").val('');
                $('.edt_qty').val('');
                $(".btn_update_bill").val('');
            });



            $("#confirm_print").click(function(e) {
                e.preventDefault();
                var prt_id = $(this).val();
                console.log(fetched_bill);
                $('.hospital_bills').html('');
                $('.iv_fluids_bill').html('');
                $.each(fetched_bill, function(ind, val) {
                    // qty = (val.qty > 1) ? 'days' : 'day';
                    if (val.cat == 'hospital') {
                        $('.hospital_bills').append(`<tr>
                        <td class="border_tb">
                            <div class="padding-x10-y5">${val.description}</div>
                        </td>
                        <td class="border_tb"><span class="padding-x10-y5">${val.qty} </span></td>
                        <td class="border_tb"><span class="padding-x10-y5">${val.amount}</span></td>
                        <td class="border_tb"><span class="padding-x10-y5">${val.total_amt}</span></td>
                    </tr>`);
                    }
                });

                if (inj_iv_count != 0) {
                    $(".iv_fluids_bill").html('');
                    $.each(fetched_bill, function(ind, val) {
                        if (val.cat == 'inj_iv') {
                            $('.iv_fluids_bill').append(`<tr>
                        <td class="border_tb">
                            <div class="padding-x10-y5">${val.description}</div>
                        </td>
                        <td class="border_tb"><span class="padding-x10-y5">${val.qty} </span></td>
                        <td class="border_tb"><span class="padding-x10-y5">${val.amount}</span></td>
                        <td class="border_tb"><span class="padding-x10-y5">${val.total_amt}</span></td>
                    </tr>`);
                        }
                    });
                } else {
                    $('.seprate_inj').html('');
                    $(".iv_fluids_bill").html('');
                }

                dis_text = $(".dis_amt").text().trim();
                adv_amt = $('.adv_amt').text().trim();
                if (dis_text === '' || dis_text === '0') {
                    $('.dis_amt_sec').hide();
                }
                if (adv_amt === '' || adv_amt === '0') {
                    $('.adv_amt_sec').hide();
                }

                var html = $('.bills_content').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.print();
                printWindow.close();
            });




        });
    </script>
</x-app-layout>
