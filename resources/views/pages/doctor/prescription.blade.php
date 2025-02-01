<link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- OPD patients table code goes here --}}
    <div>
        <div class="uppercase text-xl text-green-800 p-5 rounded-md  bg-green-200 dark:bg-gray-700 dark:text-gray-400">
            opd prescriptions
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        SL no
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Patient Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n = 0;
                @endphp
                @foreach ($data as $patient)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $n = $n + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->patient_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->admission_date }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button class="bg-green-800 prescrb" value="{{ $patient->aid }}"
                                data-modal-target="AddbillModal" data-modal-toggle="AddbillModal">Prescribe</x-button>
                            @foreach ($available as $avlble)
                                @if ($patient->aid == $avlble->admission_id)
                                    <x-button class="bg-red-800 pre_print" value="{{ $patient->aid }}"
                                        data-modal-target="print_precri"
                                        data-modal-toggle="print_precri">print</x-button>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <hr>
        </table>
    </div>
    {{-- OPD patients table code ends here --}}

    {{-- -------------------------------------------------------- --}}


    {{-- Ipd patients table goes here --}}
    <div>
        <div class="uppercase text-xl text-blue-800 p-5 rounded-md  bg-blue-200 dark:bg-gray-700 dark:text-gray-400">
            ipd discharge summary
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        SL no
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Admission ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Patient Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n = 0;
                @endphp
                @foreach ($ipd as $patient)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $n = $n + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->aid }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->patient_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->admission_date }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button id="btn-summary" class="bg-blue-800 btn-summary" value="{{ $patient->aid }}"
                                data-modal-target="AddPrecription" data-modal-toggle="AddPrecription">Summary</x-button>
                            @foreach ($ipd_available as $avlble)
                                @if ($patient->aid == $avlble->admission_id)
                                    <x-button class="bg-red-800 print_sum" value="{{ $patient->aid }}"
                                        data-modal-target="print_summary"
                                        data-modal-toggle="print_summary">print</x-button>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <hr>
        </table>
    </div>
    {{-- Ipd patients table ends here --}}

    {{-- -------------------------------------------------------- --}}



    {{-- add prescription modal starts here --}}
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
                            Add Prescription
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="AddbillModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4">
                        <input type="text" id="a_id" class="a_id hidden" disabled>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="name">
                                <x-label for="name" value="{{ __('Medication') }}" />
                                <x-input id="medicine" class="block mt-1 w-full medicine" type="text"
                                    name="medicine" value="{{ old('medicine') }}" placeholder="Enter Medication" />
                                @error('medicine')
                                    <p class="text-red-800 err_iname"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="name">
                                <x-label for="name" value="{{ __('Strenth') }}" />
                                <x-input id="strenth" class="block mt-1 w-full strenth" type="number"
                                    name="strenth" value="{{ old('strenth') }}" placeholder="Enter strenth" />
                                @error('strenth')
                                    <p class="text-red-800 err_iname"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="pt-7 px-2">
                                <x-label for="name" value="{{ __('') }}" />
                                <x-button class="bg-green-800 add_pre">
                                    add
                                </x-button>
                            </div>
                        </div>
                        {{-- <div class="grid grid-cols-3">
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="mrng" name="mrng" value="Morning" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Morning') }}</span>
                                </label>
                            </div>
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="aftr" name="aftr" value="afternoon" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Afternoon') }}</span>
                                </label>
                            </div>
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="night" name="night" value="night" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Night') }}</span>
                                </label>
                            </div>
                        </div> --}}
                    </div>

                    <textarea class="content" name="example">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div style="font-size:20px" >
                                        Name: <span class="p_name"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:20px" >
                                        Age: <span class="p_age"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                </tr>
                                <td>
                                    <div style="font-size:20px" >
                                    Address: <span class="p_address"></span>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size:20px" >
                                    Doctor: <span class="p_doctor"></span>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                            
                        <span>
                            
                            <table border="1" cellpadding="5" style="border-collapse: collapse;" class='txt-pres'>
                                <tr style="border: 2px solid black !important;padding: 5px; ">
                                    <td style="font-size:24px;border: 2px solid black !important;padding: 5px; "> Perticulars</td>
                                    <td style="font-size:24px;border: 2px solid black !important;padding: 5px; ">Qty</td>
                                </tr>
                            </table>  
                        </span>   
                        {{-- <button>Name</button>  --}}
                    </textarea>

                    <div class="py-4 px-4">
                        <x-button class="bg-blue-800 sub_pres">
                            Submit
                        </x-button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- add prescription modal ends here --}}

    {{-- -------------------------------------------------------- --}}

    {{-- print prescription modal starts here --}}
    <div>
        <div id="print_precri" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Patient Summary
                        </h3>
                        <button type="button"
                            class="cls-model text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="print_precri">
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
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="printable" id="printable">
                                <div class="hidden">
                                    <table style="margin-bottom:30px">
                                        <tr>
                                            <th colspan="3" class="center">
                                                <h1>ASHWINI HOSPITAL</h1>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">SHIVE SAGAR ARCADE 1264,
                                                RAMLINGKHIND
                                                ,
                                                BELGAUM - 590002 </th>
                                        </tr>
                                        <tr>
                                            <td class="bold">Dr. S. N. Shetti. (M.s, FAIS, FIAGES)</td>
                                            <td class="bold">
                                                <div style="display:flex;">
                                                    <div>Ph. No:</div>
                                                    <div style="margin-left:5px">2429214 <br /><br />2408357</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <table style="">
                                    <tr>
                                        <td class="bold"> Name: <strong class="pr_name"></strong></td>
                                        <td class="bold"> Age: <strong class="pr_age"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="bold p_address">Address: <strong class="pr_address"></strong></td>
                                        <td class="bold p_discharge">
                                            Doctor: <strong class="pr_doc"></strong>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <table
                                    class="w-full border border-gray-300 text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-gray-700 border border-gray-300 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr class="border border-gray-300">
                                            <th scope="col" class="px-6">
                                                Precriptions
                                            </th>
                                            <th scope="col" class="px-6">
                                                Qty
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="pres-body">

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="px-2 py-2">
                        <x-button class="con_print" id="con_print">confirm</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- print prescription modal ends here --}}

    {{-- add summary modal starts here --}}
    <div>
        <div id="AddPrecription" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Summary
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="AddPrecription">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <input type="text" id="sum_aid" class="sum_aid hidden" disabled>

                    <textarea class="content-summary" name="example">
                        <div class="summary-tab">
                        </div>
                    </textarea>

                    <div class="py-4 px-4">
                        <x-button class="bg-blue-800 sub_summary">
                            Submit
                        </x-button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- add summary modal ends here --}}

    {{-- -------------------------------------------------------- --}}

    {{-- print summary modal starts here --}}
    <div>
        <div id="print_summary" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Patient Summary
                        </h3>
                        <button type="button"
                            class="cls-model text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="print_summary">
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
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="printable_summary" id="printable_summary">

                                <div class="hidden">
                                    <table style="margin-bottom:30px">
                                        <tr>
                                            <th colspan="3" class="center">
                                                <h1>ASHWINI HOSPITAL</h1>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">SHIVE SAGAR ARCADE 1264,
                                                RAMLINGKHIND
                                                ,
                                                BELGAUM - 590002 </th>
                                        </tr>
                                        <tr>
                                            <td class="bold">Dr. S. N. Shetti. (M.s, FAIS, FIAGES)</td>
                                            <td class="bold">
                                                <div style="display:flex;">
                                                    <div>Ph. No:</div>
                                                    <div style="margin-left:5px">2429214 <br /><br />2408357</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <table style="">
                                    <tr>
                                        <td class="bold"> Name: <strong class="sum_name"></strong></td>
                                        <td class="bold"> Age: <strong class="sum_age"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="bold p_address">Address: <strong class="sum_address"></strong></td>
                                        <td class="bold p_discharge">
                                            Doctor: <strong class="sum_doc"></strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bold p_address">D.O.A: <strong class="sum_doa"></strong></td>
                                        <td class="bold p_discharge">
                                            D.O.D: <strong class="sum_dod"></strong>
                                        </td>
                                    </tr>
                                </table>
                                <br>

                                <div
                                    style="border:1px solid black;text-align:center;padding:5px;margin:20px 200px;font-weight:bold;border-radius:5px;font-size:20px">
                                    Discharge Summary
                                </div>
                                <div class="brief-summ" style="padding: 10px;">
                                   
                                </div>
                               
                            </div>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="px-2 py-2">
                        <x-button class="summ_print" id="summ_print">confirm</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- print summary modal ends here --}}

    <script src="{{ asset('js/jquery.richtext.min.js') }}"></script>

    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <script src="{{ asset('js/alert.js') }}"></script>

    <script></script>
    <script>
        $('.content').richText();

        $('.content-summary').richText();

        $(function() {
            // Function to fetch tags from the database
            function getTags(request, response) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('doc.get_medicines') }}', // Replace with your API or route URL
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

        $(document).ready(function() {

            $(".prescrb").click(function(e) {
                e.preventDefault();
                $('#medicine').focus();
                id = $(this).val();
                $('#a_id').val(id);
                $(".sub_pres").val(id);

                // $(".p_name").html("");
                // $(".p_age").html("")
                $.ajax({
                    type: "GET",
                    url: "{{ route('doc.get_prescr') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.msg == 'success') {
                            // prescription = response.list[1]['prescription']
                            console.log(response.patient['name']);
                            prescription = response.list
                            $(".p_name").html(response.patient['name']);
                            $(".p_age").html(response.patient['age']);
                            $(".p_address").html(response.patient['address']);
                            $(".p_doctor").html(response.patient['doctor']);
                            $.each(prescription, function(ind, val) {
                                $('.txt-pres').html(val.prescription);
                            });
                        } else if (response.msg == 'failed') {
                            $('.txt-pres').html("");
                            $(".p_name").html(response.patient['name']);
                            $(".p_age").html(response.patient['age']);
                            $(".p_address").html(response.patient['address']);
                            $(".p_doctor").html(response.patient['doctor']);
                        }
                    }
                });
            });

            $('.add_pre').click(function(e) {
                e.preventDefault();
                aid = $('.a_id').val();
                med = $('#medicine').val();
                str = $('#strenth').val();
                console.log(med, str, aid);
                $(".txt-pres").append(
                    ` <tr>
                        <td style="px-6 py-3">${med}<br>1-1-1</td>
                         <td style="px-6 py-3">${str}</td>
                        </tr>`
                );
                $('#medicine').val("");
                $('#strenth').val("");
                elements = $('.txt-pres').html();
                console.log(elements);
                // $('.txt-pres').html("");
            });

            $('.sub_pres').click(function(e) {
                e.preventDefault();
                tablets = $('.txt-pres').html();
                id = $(this).val();
                console.log(tablets, id);
                if (tablets == '') {
                    Swal.fire("There is no prescription");
                } else {
                    $.ajax({
                        type: "get",
                        url: "{{ route('doc.insert_prescription') }}",
                        data: {
                            id: id,
                            medicines: tablets
                        },
                        // dataType: "dataType",
                        success: function(response) {
                            Swal.fire("Prescriptions have been submitted");
                            $(".close-pop").trigger('click');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            });

            $(".pre_print").click(function(e) {
                e.preventDefault();
                a_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('doc.get_pre_print') }}",
                    data: {
                        id: a_id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        msg = response.msg
                        if (msg == 'success') {
                            medicines = response.tablets[0]['prescription']
                            $(".pres-body").html(medicines);
                            $('.pr_name').html(response.patient_details['name']);
                            $('.pr_age').html(response.patient_details['age']);
                            $('.pr_doc').html(response.patient_details['doctor']);
                            $('.pr_address').html(response.patient_details['address']);
                            $('#con_print').trigger('click');
                        } else if (msg == 'failed') {
                            $(".pres-body").html("");
                            $('.cls-model').trigger('click');
                            Swal.fire("there are no prescriptions")
                        }
                    }
                });
            });


            $('.btn-summary').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                summary = $(".summary-tab").html();
                console.log(id);
                $(".sum_aid").val(id);

                $.ajax({
                    type: "get",
                    url: "{{ route('doc.summary') }}",
                    data: {
                        id: id,
                        summary: summary
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.msg == 'Sucessfull') {
                            $(".summary-tab").html(response.summary[0]['summary']);
                        } else if (response.msg == 'failed') {
                            $(".summary-tab").html(response.summary);
                        }
                    }
                });
            });

            $('.sub_summary').click(function(e) {
                e.preventDefault();
                id = $(".sum_aid").val();
                summary = $('.summary-tab').html();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // console.log(summary);
                if (summary == '') {
                    Swal.fire('there is no summary to submit');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('doc.sub_sammary') }}",
                        data: {
                            id: id,
                            summary: summary
                        },
                        // dataType: "dataType",
                        success: function(response) {
                            Swal.fire("submitted successfully");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            });



            $(".con_print").click(function(e) {
                e.preventDefault();
                console.log("clicked");
                var contentToPrint = $("#printable").html();
                // Open a new window and set its content to the div's content
                sign = `<div id="bottom-right-div">
        <h4>Signature</h4>
    </div>`;
                date = `<div id="bottom-left-div">
        <h4>Date: 08/04/2023</h4>
    </div>`
                var printWindow = window.open("");
                printWindow.document.write(`<html><head><title>Print</title>
                    <style>       
                        @media print {

            table {
                border-collapse: collapse;
                width: 100%;
                border-radius:10px;
            }

            table th, table td {
                border: 1px solid black !important;
                padding: 8px;
                text-align: left;
                
            }
            .hosp_info{
                text-align:center;
            }   
            
            .bold{
            font-weight:400;}
            .center{
            text-align: center
            }
            #bottom-right-div {
    position: fixed;
    bottom: 10px;
    right: 10px;
    padding: 10px; 
}
#bottom-left-div {
    position: fixed;
    bottom: 10px;
    left: 10px;
    padding: 10px; 
}
body {font-family: 'Poppins', sans-serif;
font-family: 'Work Sans', sans-serif; }

            /* Hide non-printable elements */
            .no-print {
                display: none;
            }
        }</style></head><body>`);


                printWindow.document.write(contentToPrint);
                printWindow.document.write(sign, date);
                printWindow.document.write('</body></html>');
                // printWindow.document.close();
                // Print the new window's content
                printWindow.print();
                printWindow.close();
                $(".cls-model").trigger('click');
            });


            $(".summ_print").click(function(e) {
                e.preventDefault();
                console.log("clicked");
                var contentToPrint = $("#printable_summary").html();
                // Create "sign" and "date" elements
                // var sign = '<div id="bottom-right-div"><h4>Signature</h4></div>';
                // var date = '<div id="bottom-left-div"><h4>Date: 08/04/2023</h4></div>';
                // Open a new window and set its content to the div's content
                var printWindow = window.open("");
                printWindow.document.write(
                    `<html><head><title>Print</title><style>@media print { table { border-collapse: collapse; width: 100%; border-radius: 10px; } table th, table td { border: 1px solid black !important; padding: 8px; text-align: left; } .hosp_info { text-align: center; } .bold { font-weight: 400; } .center { text-align: center; }  body { font-family: 'Poppins', sans-serif; font-family: 'Work Sans', sans-serif; } .no-print { display: none; } }</style></head><body>`
                );
                printWindow.document.write(contentToPrint);
                // printWindow.document.write(sign);
                // printWindow.document.write(date);
                printWindow.document.write('</body></html>');
                printWindow.document.close(); // Close HTML and body tags
                // Print the new window's content
                printWindow.print();
                printWindow.close();
            });

            $('.print_sum').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('doc.get_sum_print') }}",
                    data: {
                        id: id
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        console.log(response.date);
                        if (response.msg == 'success') {
                            medicines = response.summary[0]['summary']
                            $(".brief-summ").html(medicines);
                            $('.sum_name').html(response.patient_details['name']);
                            $('.sum_age').html(response.patient_details['age']);
                            $('.sum_doc').html(response.patient_details['doctor']);
                            $('.sum_address').html(response.patient_details['address']);
                            $('.sum_dod').html(response.admdate);
                            $('.sum_doa').html(response.dis_date);
                            $('#summ_print').trigger('click');
                            $('.cls-model').trigger('click');
                        } else if (response.msg == 'failed') {
                            $("..brief-summ").html("");
                            $('.cls-model').trigger('click');
                            Swal.fire("there are no prescriptions")
                        }
                    }
                });

            });
        });
    </script>
</x-app-layout>
