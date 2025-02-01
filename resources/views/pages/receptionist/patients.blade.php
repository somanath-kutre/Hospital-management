<link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<x-app-layout>
    <div class="hidden">
        <input type="text" class="" id="aid">
        <input type="text" class="" id="patient_id">
        <input type="text" class="" id="opd_id">
    </div>


    <div class="border-b pb-4">
        <div class="p-4 text-xl text-green-700 ">
            Search Patients
        </div>
        <div class="grid grid-cols-3 gap-4 px-4 pt-2 exist_ptn_serch">
            <div>
                <x-label for="" value="{{ __('OPD Number') }}" />
                <x-input id="opd_id_no" name="opd_id_no" class="block mt-1 w-full" placeholder="Search OPD Number"
                    inputmode="numeric" />
            </div>
            <div>
                <x-label for="" value="{{ __('Patient Id') }}" />
                <x-input id="patn_id" name="patn_id" class="block mt-1 w-full" placeholder="Search Patient Id"
                    inputmode="numeric" />
            </div>
            <div>
                <x-label for="phone" value="{{ __('Phone Number') }}" />
                <x-phone id="phone" name="phone" :value="old('phone')" placeholder="Enter phone number" />
            </div>
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        {{-- <thead class="patients_table_head text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    SL No
                </th>
                <th scope="col" class="px-6 py-3">
                    Patient Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead> --}}
        <thead class="patients_table_head text-gray-700  bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

        </thead>
        <tbody class="doc_ptns ">
            @php
                $n = 1;
            @endphp
            @foreach ($all_data as $patient)
                <tr class="hidden">
                    <td class="px-6 py-4">
                        {{ $n++ }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $patient->name }}
                    </td>
                    <td class="px-6 py-4">
                        <button class="btn_vw_patn"
                            value="{{ $patient->patient_id }}"><x-buttons.green>View</x-buttons.green></button>
                        <button class="btn_vw_history" value="{{ $patient->patient_id }}" data-modal-target="history"
                            data-modal-toggle="history"><x-buttons.green>History</x-buttons.green></button>
                        <button class="" value="{{ $patient->patient_id }}" data-modal-target="meds_modal"
                            data-modal-toggle="meds_modal"><x-buttons.green>Medicine</x-buttons.green></button>
                        <button class="btn_test" value="{{ $patient->patient_id }}" data-modal-target="investigation"
                            data-modal-toggle="investigation"><x-buttons.green>Tests</x-buttons.green></button>
                        <button class=""
                            value="{{ $patient->patient_id }}"><x-buttons.green>appointment</x-buttons.green></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 patients_tb">
        <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    SL No
                </th>
                <th scope="col" class="px-6 py-3">
                    Patient Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class=" ">
            @php
                $n = 1;
            @endphp
            @foreach ($admission_data as $adm_ptns)
                <tr class="">
                    <td class="px-6 py-4">
                        {{ $n++ }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $adm_ptns->patient_name }}
                    </td>
                    <td class="px-6 py-4">
                        <x-button id="btn_select_ptns" class="btn_select_ptns"
                            value="{{ $adm_ptns->patient_id }}">Select</x-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- add history modal starts here --}}
    <div class="">
        <div id="history" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-4xl max-h-full main_model">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Summary
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="history">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <input type="text" id="sum_aid" class="sum_aid hidden" disabled>
                    <div class="history_tab">
                        <textarea class="content-summary" name="example">
                        
                       
                    </textarea>
                    </div>
                    <div class="py-4 px-4">
                        <x-button class="bg-blue-800 save_history">
                            Save
                        </x-button>
                        <x-button class="print_record">Print
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add history modal ends here --}}

    {{-- add prescription modal starts here --}}
    <div>
        <div id="meds_modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Prescription
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="meds_modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <div class="p-4">
                            <input type="text" id="a_id" class="a_id hidden" disabled>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="">
                                    <x-label for="name" value="{{ __('Medication') }}" />
                                    <x-input id="medicine" class="block mt-1 w-full medicine" type="text"
                                        name="medicine" value="{{ old('medicine') }}"
                                        placeholder="Enter Medication" />
                                </div>
                                <div class="">
                                    <x-label for="name" value="{{ __('Strenth') }}" />
                                    <x-input id="strenth" class="block mt-1 w-full strenth" type="number"
                                        name="strenth" value="{{ old('strenth') }}" placeholder="Enter strenth" />
                                </div>
                                <div>
                                    <x-label for="" value="{{ __('Dosage') }}" />
                                    <div class="grid grid-cols-4 gap-2">
                                        <div class="mt-3">
                                            <input id="morn-check" type="checkbox"s value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                checked>
                                            <label for="default-checkbox"
                                                class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">Mor</label>
                                        </div>
                                        <div class="mt-3">
                                            <input id="aft-check" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                checked>
                                            <label for="default-checkbox"
                                                class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">aft</label>
                                        </div>
                                        <div class="mt-3">
                                            <input id="nght-check" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                checked>
                                            <label for="default-checkbox"
                                                class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">Ngt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-2">
                                    <x-label for="name" value="{{ __('') }}" />
                                    <x-button class="bg-green-800 add_pre">
                                        add it
                                    </x-button>
                                </div>
                            </div>
                            <div class="">
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Medication Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Dosage
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Streanth
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="meds_list">

                                    </tbody>
                                </table>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('rec.prt_meds') }}" class="pt-3">
                                    @csrf
                                    <div class="prt_div">

                                    </div>

                                    <div class="btn_div">
                                        {{-- <x-button class="bg-red-800 btn_pay_bill" id="btn_pay_bill" value="">
                                            Print
                                        </x-button> --}}

                                        <x-button class="btn-prt-medlist" id="btn-prt-medlist">Print</x-button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- add prescription modal ends here --}}

    {{-- add history modal starts here --}}
    <div class="">
        <div id="investigation" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-4xl max-h-full main_model">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Investigations
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="investigation">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->

                    <div class="grid grid-cols-3 gap-4 p-4">
                        <div class="">
                            <x-label for="name" value="{{ __('Test Name') }}" />
                            <x-input id="test_name" class="block mt-1 w-full test_name" type="text"
                                name="test_name" placeholder="Enter Test" />
                        </div>
                        <div class="mt-6">
                            <x-button class="add_test" id="add_test">add</x-button>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="p-4">

                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Sl NO
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            TEST Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="tests_table">


                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="p-4">

                        <div class="grid grid-cols-2 gap-2 px-6 py-2">
                            <div><x-label for="" value="{{ __('Scan Center') }}" />
                                <x-select id="scan_sel" class="scan_sel block mt-1 w-full" :title="'Select Scan Center'"
                                    :options="[
                                        'Disha laboratory' => 'Disha laboratory',
                                        'Shiv Sai scan centre' => 'Shiv Sai scan centre',
                                        'Ruby MRI scan centre' => 'Ruby MRI scan centre',
                                        'Sai Vijay scan centre' => 'Sai Vijay scan centre',
                                        'Asha Diagnostic centre' => 'Asha Diagnostic centre',
                                        'Ruby Medical Centre' => 'Ruby Medical Centre',
                                        'Belcity' => 'Belcity',
                                        'Belgaum Scan Centre' => 'Belgaum Scan Centre',
                                    ]" />
                            </div>

                            <div class="py-6 px-6 font-bold text-2xl">
                                <x-button class="btn-prt-lablist bg-teal-700" id="btn-prt-lablist">Print</x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add history modal ends here --}}

    <div class="patient_details border">
        <div class="p-4 head_history"></div>
        <div class="patient_history m-4 p-4 ">
        </div>
    </div>

    <div class="opd_paper_div hidden">
        <x-papers.editable_opd_paper />
    </div>



    <div class="test_to_be_print hidden" style="width:100%">

    </div>

    <div class="hidden final_tests_table">
        <x-papers.labtest />
    </div>

    <div class="meds_to_be_print hidden" style="width:100%">
    </div>

    <div class="hidden final_meds_table">
        <x-papers.medication_new />
    </div>


    <div class="appoint_paper hidden">
        <x-papers.appoint />
    </div>


    {{-- add History modal ends here --}}
    <script>
        function handleNumericInput(inputId, maxLength) {
            $(inputId).on('input', function() {
                const input = $(this).val().replace(/\D/g, '').substring(0, maxLength);
                $(this).val(input);
            });
        }
        handleNumericInput('#patn_id', 10);
        handleNumericInput('#opd_id_no', 10);
        handleNumericInput('#phone', 10); // Usage example for '#test' input with a maximum length of 10 characters
    </script>

    <script src="{{ asset('js/jquery.richtext.min.js') }}"></script>

    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <script src="{{ asset('js/alert.js') }}"></script>

    <script src="{{ asset('js/certificates.js') }}"></script>

    <script>
        $(function() {
            // Function to fetch tags from the database
            function getTags(request, response) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('rec.get_medicines') }}', // Replace with your API or route URL
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                        var list = response(data);
                        console.log(list);

                    }
                });
            }

            // Initialize the autocomplete widget
            $("#medicine").autocomplete({
                source: getTags // Use the getTags function as the source
            });

        });

        $(function() {
            // Function to fetch tags from the database
            function getTest(request, response) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('rec.get_test_list') }}', // Replace with your API or route URL
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                        var list = response(data);
                        console.log(list);

                    }
                });
            }

            // Initialize the autocomplete widget
            $("#test_name").autocomplete({
                source: getTest // Use the getTags function as the source
            });

        });
    </script>

    <script>
        $('.content').richText();
        $('.content-summary').richText();
        $(document).ready(function() {
            function fill_table(list, aid) {
                p_data = list;
                console.log(p_data);
                $("#add_test").val(aid);
                $(".patient_history").html('');
                $(".head_history").html('');
                $('.doc_ptns').html('');
                $('.patients_table_head').html('');

                $('.patients_table_head').append(` 
                <tr>
                <th scope="col" colspan="4" class="px-6 py-3 text-xl" >
                    ${p_data['name']}
                </th>
                <th scope="col"  class="px-6 py-3 text-xl" >
                    <x-button class="btn_close_ptn">X</x-button>
                </th>
            </tr>`);

                $('.doc_ptns').append(`
                <tr>   
                    <td class="px-6 py-4">
                        <button class="btn_vw_patn_on" value="${p_data['patient_id']}"><x-buttons.green>View</x-buttons.green></button>
                    </td>
                    <td>
                        <button class="btn_vw_history_on" value="${p_data['patient_id']}" data-modal-target="history"
                            data-modal-toggle="history"><x-buttons.green>Case Paper</x-buttons.green></button>
                    </td>
                    <td>
                        <button class="btn_meds" value="${aid}" data-modal-target="meds_modal" data-modal-toggle="meds_modal" ><x-buttons.green>Medicine</x-buttons.green></button>
                    </td>                        
                    <td>
                        <button class="btn_test" value="${p_data['patient_id']}" data-modal-target="investigation"
                            data-modal-toggle="investigation"><x-buttons.green>Tests</x-buttons.green></button>
                    </td>
                    <td>
                        <button class="btn_print_apt" value=""><x-buttons.green>appointment</x-buttons.green></button>
                    </td>                       
                   </tr>`);

                $('.ip_ptname').html(`${p_data['name']}`);
                $('.opd_no').html(`${p_data['id']}`);
                $('.ip_age').html(`${p_data['age']}`);
                $('.ip_gender').html(`${p_data['gender']}`);
                $('.p_id').html(`${p_data['patient_id']}`);
                $('.ip_address').html(`${p_data['address']}`);
                $('.ip_phone').html(`${p_data['phone']}`);
                $('.ip_date_adm').html(`${p_data['a_date']}`);
                $(".prescription_date").html(current_date);
            }
            $("#opd_id_no").change(function(e) {
                e.preventDefault();
                opd_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_ext_pts') }}",
                    data: {
                        opd_id_no: opd_id
                    },
                    success: function(response) {
                        if (response.error !== 'Not_found') {
                            list = response.opd_details;
                            admission_deatails = response.admission_deatails;
                            admission_id = response.admission_deatails['id'];

                            $("#aid").val(response.admission_deatails['id']);
                            $("#patient_id").val(list['patient_id']);
                            $("#opd_id").val(list['id']);

                            fill_table(list, admission_id);
                            $("#phone").val(list['phone']);
                            $("#patn_id").val(list['patient_id'])
                            $("#add_test").val(response.admission_deatails['id']);

                            $(".patients_tb").hide();
                            $(".doc_ptns").show();
                            $(".patients_table_head").show();
                        }
                    }
                });
            });
            $("#phone").change(function(e) {
                e.preventDefault();
                var phone = $(this).val();
                if (phone.length === 0) {
                    phone = null;
                }
                if (phone.length !== 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.get_ext_pts') }}",
                        data: {
                            phone: phone
                        },
                        success: function(response) {
                            if (response.error !== 'Not_found') {
                                list = response.opd_details;
                                admission_id = response.admission_deatails['id'];
                                $("#add_test").val(response.admission_deatails['id']);

                                $("#aid").val(response.admission_deatails['id']);
                                $("#patient_id").val(list['patient_id']);
                                $("#opd_id").val(list['id']);
                                fill_table(list, admission_id);
                                $("#patn_id").val(list['patient_id'])
                                $("#opd_id_no").val(list['id']);

                                $(".patients_tb").hide();
                                $(".doc_ptns").show();
                                $(".patients_table_head").show();
                            }
                        }
                    });
                }
            });
            $("#patn_id").change(function(e) {
                e.preventDefault();
                var ptn_id = $(this).val();
                console.log(ptn_id);
                if (patn_id.length !== 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.get_ext_pts') }}",
                        data: {
                            ptn_id: ptn_id
                        },
                        success: function(response) {
                            if (response.error !== 'Not_found') {
                                list = response.opd_details;
                                admission_id = response.admission_deatails['id'];
                                $("#add_test").val(response.admission_deatails['id']);
                                $("#aid").val(response.admission_deatails['id']);
                                $("#patient_id").val(list['patient_id']);
                                $("#opd_id").val(list['id']);
                                fill_table(list, admission_id);
                                $("#phone").val(list['phone']);
                                $("#opd_id_no").val(list['id']);

                                $(".patients_tb").hide();
                                $(".doc_ptns").show();
                                $(".patients_table_head").show();
                            }
                        }

                    });
                }
            });

            $(".btn_select_ptns").click(function(e) {
                e.preventDefault();
                ptn_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('rec.get_ext_pts') }}",
                    data: {
                        ptn_id: ptn_id
                    },
                    success: function(response) {
                        if (response.error !== 'Not_found') {
                            list = response.opd_details;
                            admission_id = response.admission_deatails['id'];
                            $("#add_test").val(response.admission_deatails['id']);
                            $("#aid").val(response.admission_deatails['id']);
                            $("#patient_id").val(list['patient_id']);
                            $("#patn_id").val(ptn_id);
                            $("#opd_id").val(list['id']);
                            fill_table(list, admission_id);
                            $("#phone").val(list['phone']);
                            $("#opd_id_no").val(list['id']);
                            $(".patients_tb").hide();
                            $(".doc_ptns").show();
                            $(".patients_table_head").show();
                        }
                    }
                });
            });

            $(document).on('click', '.btn_close_ptn', function(e) {
                e.preventDefault();
                $(".patients_tb").show();
                $(".doc_ptns").hide();
                $(".patients_table_head").hide();
                $(".head_history").html('');
                $(".patient_history").html('');

                $("#opd_id_no").val('');
                $("#patn_id").val('');
                $("#phone").val('');
            })

            $(".btn_vw_patn").click(function(e) {
                e.preventDefault();
                id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_opd_records') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.msg === 'existing') {
                            $(".patient_history").html('');
                            $(".head_history").html('');

                            $('.head_history').prepend(
                                `<p class="text-xl text-center">Patient Records</p>`);
                            $(".patient_history").html(response.data['opd_details']);
                        }
                        if (response.msg === 'new') {
                            $(".patient_history").html('');
                            $(".head_history").html('');

                            $('.head_history').prepend(
                                `<p class="text-xl text-center">Patient Records</p>`);
                            $(".patient_history").html(response.data[0]['master']);
                        }
                    }
                });
            });

            $(document).on('click', '.btn_vw_patn_on', function(e) {
                e.preventDefault();
                id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_opd_records') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.msg === 'existing') {
                            $(".patient_history").html('');
                            $(".head_history").html('');

                            $('.head_history').prepend(
                                `<p class="text-xl text-center">Patient Records</p>`);
                            $(".patient_history").html(response.data['opd_details']);
                        }
                        if (response.msg === 'new') {
                            $(".patient_history").html('');
                            $(".head_history").html('');

                            $('.head_history').prepend(
                                `<p class="text-xl text-center">Patient Records</p>`);
                            $(".patient_history").html(response.data[0]['master']);
                        }
                    }
                });
            });

            $(".btn_vw_history").click(function(e) {
                e.preventDefault();
                hist_id = $(this).val();
                $(".save_history").val(hist_id);

                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_opd_records') }}",
                    data: {
                        id: hist_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.msg === 'existing') {
                            $(".patient_history").html('');
                            $(".head_history").html('');
                            $(".richText-editor").html(response.data['opd_details']);
                        }
                        if (response.msg === 'new') {
                            $(".patient_history").html('');
                            $(".head_history").html('');
                            $(".richText-editor").html(response.data[0]['master']);
                        }
                    }
                });
            });

            $(document).on('click', '.btn_vw_history_on', function(e) {
                e.preventDefault();
                hist_id_on = $(this).val();
                $(".save_history").val(hist_id_on);
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_opd_records') }}",
                    data: {
                        id: hist_id_on
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.msg === 'existing') {
                            $(".patient_history").html('');
                            $(".head_history").html('');
                            $(".richText-editor").html(response.data['opd_details']);
                        }
                        if (response.msg === 'new') {
                            $(".patient_history").html('');
                            $(".head_history").html('');
                            $(".richText-editor").html(response.data[0]['master']);
                        }

                    }
                });

                $('#history').removeClass('hidden');
                $('#history').attr('aria-hidden', 'false');
                $('#history').addClass('overflow-hidden');
            });

            $(".save_history").click(function(e) {
                e.preventDefault();
                opd_data = $(".richText-editor").html();
                // console.log(opd_data);
                id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('rec.insert_records') }}",
                    data: {
                        patient_id: id,
                        opd_details: opd_data
                    },
                    success: function(response) {
                        if (response.msg != 'Error') {
                            alert(response.msg)
                        }
                    }
                });
            });

            $('.print_record').click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                console.log(id);
                data = $('.richText-editor').html();
                $('.opd_data_div').html(data);
                // fill_data(id, opd_data);
                print_opd_paper();

                function print_opd_paper() {
                    var opd_cp = $('.opd_paper_div').html();
                    var printWindow = window.open("");
                    printWindow.document.write(opd_cp);
                    printWindow.print();
                    printWindow.close();
                }
            });

            $(document).on('click', '.btn_meds', function(e) {
                e.preventDefault();
                $('#meds_modal').removeClass('hidden');
                $('#meds_modal').attr('aria-hidden', 'false');
                $('#meds_modal').addClass('overflow-hidden');

                $(".patient_history").html('');
                $(".head_history").html('');
                $('#medicine').val('');


                var aid = $(this).val();
                console.log(aid);
                $('.a_id').val(aid);

                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_meds') }}",
                    data: {
                        admission_id: aid,
                    },
                    success: function(response) {
                        meds = response.all_meds;
                        if (response.msg != 'error') {
                            gen_table(meds);
                            fill_meds_table(meds);
                            $('#medicine').focus();
                            $(".btn_div").show();
                        } else {
                            $('.meds_list').html("");
                        }

                        if (response.msg == 'error' || meds == '') {
                            $(".btn_div").hide();
                        }
                    }
                });


            });

            $('.add_pre').click(function(e) {
                e.preventDefault();
                var aid = $('.a_id').val();
                var mor_chk = $('#morn-check').is(':checked');
                var aft_chk = $('#aft-check').is(':checked');
                var ngt_chk = $('#nght-check').is(':checked');
                var name = $('#medicine').val();
                var str = $('#strenth').val();

                mor_chk = mor_chk ? '1' : '0';
                aft_chk = aft_chk ? '1' : '0';
                ngt_chk = ngt_chk ? '1' : '0';

                var dosage = `${mor_chk}-${aft_chk}-${ngt_chk}`;

                if (name != '' && str != '' && dosage != '0-0-0') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('rec.add_prescription') }}",
                        data: {
                            admission_id: aid,
                            medicine: name,
                            dosage: dosage,
                            strenth: str
                        },
                        success: function(response) {
                            console.log(response);
                            meds = response.old_meds
                            // gen_table(meds);
                            // fill_meds_table(meds);

                            if (response.msg != 'error') {
                                gen_table(meds);
                                fill_meds_table(meds)
                                $(".btn_div").show();
                            }

                            if (response.msg == 'error' || meds == '') {
                                $(".btn_div").hide();
                            }


                            $('#medicine').val('');
                            $('#strenth').val('');
                            $('#medicine').focus();
                        }
                    });
                } else {
                    swal.fire('invalid prescription');
                }
            });

            $(document).on('click', '.btn-rm-meds', function(e) {
                e.preventDefault();
                var id = $(this).val();
                aid = $("#aid").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('rec.dlt_med') }}",
                    data: {
                        id: id,
                        admission_id: aid
                    },
                    success: function(response) {
                        meds = response.meds
                        // gen_table(meds);
                        console.log(meds);
                        // fill_meds_table(meds);

                        if (response.msg != 'error') {
                            gen_table(meds);
                            fill_meds_table(meds)
                            $(".btn_div").show();
                        }

                        if (response.msg == 'error' || meds == '') {
                            $(".btn_div").hide();
                        }
                    }
                });
            });

            function gen_table(meds) {
                $('.meds_list').html("");
                $.each(meds, function(ind, val) {
                    admission_id = val.admission_id
                    $('.meds_list').append(`<tr>
                                        <td class="px-6 py-3">${val.medicine}</td>
                                        <td class="px-6 py-3">${val.dosage}</td>
                                        <td class="px-6 py-3">${val.strenth}</td>
                                        <td><x-button class="btn-rm-meds" value="${val.id}">remove</x-button></td>
                                    </tr>`);
                });
            }

            $('.btn-prt-medlist').click(function(e) {
                e.preventDefault();
                // console.log(pt_id);
                table_list = $('.meds_to_be_print').html();
                // console.log(table_list);

                $('.template_meds_list').html(table_list);

                test_html = $('.template_meds_list').html();
                // console.log(test_html);

                var html = $('.final_meds_table').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.print();
                printWindow.close();

            });


            function fill_meds_table(meds) {
                // $('.tests_table').html('');
                sl = 1
                var tableCounter = 1; // Counter to track the number of tables created

                $('.meds_to_be_print').html('');
                $.each(meds, function(ind, val) {
                    // Check if the current index is a multiple of 8 to create a new table
                    if (ind % 10 === 0) {
                        // Create a new table and update the counter
                        var marginStyle = (tableCounter > 1) ? '' : '';
                        $(".meds_to_be_print").append(
                            `<table class="table" style="border-collapse:collapse;border:1px solid #000000;width:100%;${marginStyle}">
                                    <thead>
                                        <tr>
                                        <th style="padding:5px;border:1px solid #000000;text-align:left">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="32" width="28"
                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    d="M32 0C14.3 0 0 14.3 0 32V192v96c0 17.7 14.3 32 32 32s32-14.3 32-32V224h50.7l128 128L137.4 457.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L288 397.3 393.4 502.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L333.3 352 438.6 246.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 306.7l-85.8-85.8C251.4 209.1 288 164.8 288 112C288 50.1 237.9 0 176 0H32zM176 160H64V64H176c26.5 0 48 21.5 48 48s-21.5 48-48 48z" />
            </svg>
            <span style="margin-left:10px">Medicine</span></th>
                                        <th style="padding:5px;border:1px solid #000000;text-align:left">Dosage</th>
                                        <th style="padding:5px;border:1px solid #000000;text-align:left">Strength</th>
                                        </tr>
                                    </thead>
                                    <tbody class="meds_body_${tableCounter}"></tbody>
                                </table>`
                        );
                        tableCounter++;
                    }

                    // Append the row to the current table (updated the tableCounter here)
                    $(".meds_body_" + (tableCounter - 1)).append(
                        `<tr>
                                <td style="padding:5px;border:1px solid #000000;">${val.medicine}</td>
                                <td style="padding:5px;border:1px solid #000000;">${val.dosage}</td>
                                <td style="padding:5px;border:1px solid #000000;">${val.strenth}</td>
                                </tr>`
                    );
                });
            }



            $(document).on('click', '.btn_test', function(e) {
                e.preventDefault();
                $(".test_name").val('');
                $('#investigation').removeClass('hidden');
                $('#investigation').attr('aria-hidden', 'false');
                $('#investigation').addClass('overflow-hidden');

                $(".patient_history").html('');
                $(".head_history").html('');

                $("#test_name").focus();


                patient_id = $("#patient_id").val();
                aid = $("#aid").val();
                opd_id = $("#opd_id").val();

                console.log(aid, patient_id, opd_id);

                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_tests') }}",
                    data: {
                        opd_id: opd_id
                    },
                    success: function(response) {
                        console.log(response);
                        list = response.msg;
                        p_list = response.pateint_details;
                        fill_test_table(list, p_list);
                    }
                });
            });


            function fill_test_table(list, list2) {
                $('.name').html(list2[0]['name']);
                $('.age').html(list2[0]['age']);
                $('.gender').html(list2[0]['gender']);
                $('.phone').html(list2[0]['phone']);

                $('.tests_table').html('');
                sl = 1
                if (list === 'not test found') {
                    $('.tests_table').html(
                        '<h1 class="text-center text-2xl text-red-900">There are no tests</h1>');
                } else {
                    $.each(list, function(ind, val) {
                        $('.tests_table').append(`<tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       ${sl++}
                                        </td>
                                        <td scope="row" class="px-6 py-4 ">
                                            ${val.test_name}
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-button class="btn-dlt-labtest" value="${val.id}">Delete</x-button>
                                        </td>
                                    </tr>`);
                    });
                    var tableCounter = 1; // Counter to track the number of tables created

                    $('.test_to_be_print').html('');
                    $.each(list, function(ind, val) {
                        // Check if the current index is a multiple of 8 to create a new table
                        if (ind % 8 === 0) {
                            // Create a new table and update the counter
                            var marginStyle = (tableCounter > 1) ? '' : '';
                            $(".test_to_be_print").append(
                                `<table class="table" style="border-collapse:collapse;border:1px solid #000000;width:100%;${marginStyle}"><tbody class="tests_body_${tableCounter}"></tbody></table>`
                            );
                            tableCounter++;
                        }

                        // Append the row to the current table (updated the tableCounter here)
                        $(".tests_body_" + (tableCounter - 1)).append(
                            `<tr><td style="padding:10px;border:1px solid #000000;">${val.test_name}</td></tr>`
                        );
                    });

                }
            }

            $(".add_test").click(function(e) {
                e.preventDefault();
                patient_id = $(".btn_test").val();
                name = $(".test_name").val();
                aid = $("#aid").val();
                patient_id = $("#patient_id").val();
                opd_id = $("#opd_id").val();
                list = {
                    opd_id: opd_id,
                    patient_id: patient_id,
                    admission_id: aid,
                    test_name: name
                }
                console.log(list);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('rec.insert_test') }}",
                    data: {
                        test: list
                    },
                    success: function(response) {
                        if (response.msg === 'no tests') {
                            Swal.fire('NO TEST TO INSERT');
                        }
                        if (response.msg === 'SuccessFull') {
                            console.log(response);
                            tests = response.tests;
                            p_list = response.pateint_details;
                            console.log(tests, p_list);
                            fill_test_table(tests, p_list);
                            $(".test_name").val('');
                            $("#test_name").focus();
                        }
                    }
                });


            });

            $(document).on('click', '.btn-dlt-labtest', function(e) {
                e.preventDefault();
                labtest_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.dlt_labtest') }}",
                    data: {
                        id: labtest_id
                    },
                    success: function(response) {
                        list = response.msg;
                        p_list = response.pateint_details;
                        fill_test_table(list, p_list);
                    }
                });
            });

            $('.btn-prt-lablist').click(function(e) {
                e.preventDefault();

                var center = $('.scan_sel').val();
                if (center === 'Select Scan Center') {
                    Swal.fire('Please Select The Center')
                } else {
                    $('.scan_center').html(center);
                    pt_id = $(this).val();
                    // console.log(pt_id);
                    table_list = $('.test_to_be_print').html();
                    // console.log(table_list);

                    $('.template_list').html(table_list);

                    test_html = $('.template_list').html();
                    console.log(test_html);

                    var html = $('.final_tests_table').html();
                    var printWindow = window.open("");
                    printWindow.document.write(html);
                    printWindow.print();
                    printWindow.close();
                }
            });

            $(document).on('click', '.btn_print_apt', function(e) {
                e.preventDefault();
                console.log("clicked");

                var appt = $('.appoint_paper').html();
                var printWindow = window.open("");
                printWindow.document.write(appt);
                printWindow.document.write(`</body></html>`);
                printWindow.print();
                printWindow.close();
            })


        });
    </script>
</x-app-layout>
