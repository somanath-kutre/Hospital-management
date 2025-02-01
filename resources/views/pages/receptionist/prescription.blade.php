<link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- OPD patients table code goes here --}}
    <div class="hidden">
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


    <div class="find_patient p-4">
        <div class="text-xl pb-4">
            Search Patients
        </div>
        <div class="grid grid-cols-2 gap-4">

            <div>
                <x-label for="" value="{{ __('IPD Number') }}" />
                <x-input id="ipd_id_no" name="ipd_id_no" class="block mt-1 w-full" placeholder="Search IPD Number"
                    inputmode="numeric" />
            </div>
            {{-- <div>
                <x-label for="" value="{{ __('OPD Number') }}" />
                <x-input id="opd_id_no" name="opd_id_no" class="block mt-1 w-full" placeholder="Search OPD Number"
                    inputmode="numeric" />
            </div> --}}

        </div>
    </div>
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
                    {{-- <th scope="col" class="px-6 py-3">
                      Admission ID
                    </th> --}}
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
            <tbody class="ipd_tb_body">
                @php
                    $n = 0;
                @endphp
                @foreach ($ipd as $patient)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $n = $n + 1 }}
                        </td>
                        {{-- <td class="px-6 py-4">
                            {{ $patient->aid }}
                        </td> --}}
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
                            {{-- @foreach ($ipd_available as $avlble)
                                @if ($patient->aid == $avlble->admission_id)
                                    <x-button class="bg-red-800 print_sum" value="{{ $patient->aid }}"
                                        data-modal-target="print_summary"
                                        data-modal-toggle="print_summary">print</x-button>
                                @endif
                            @endforeach --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <hr>
        </table>
        {{ $ipd->links() }}
    </div>
    {{-- Ipd patients table ends here --}}

    {{-- -------------------------------------------------------- --}}
    {{-- add summary modal starts here --}}
    <div>
        <div id="AddPrecription" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-4xl max-h-full">
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

                    <textarea class="content-summary" name="example">
                        {{-- <div class="summary-tab">
                        </div> --}}
                    </textarea>

                    <div class="py-4 px-4">
                        <x-button class="bg-blue-800 sub_summary">
                            Submit
                        </x-button>
                        <x-button class="bg-red-800 print_sum">print</x-button>
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
                            <div id="printable_summary">
                                <x-papers.summary />
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

        $(document).ready(function() {

            $("#opd_id_no").change(function(e) {
                e.preventDefault();
                opd_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_ipd_patients') }}",
                    data: {
                        opd_id: opd_id
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        console.log(response);
                        if (response.msg == 'Sucessfull') {
                            gen_table(response.ipd_list)
                            $("#ipd_id_no").val('');
                        } else {
                            Swal.fire('No Records Found')
                            $('.ipd_tb_body').html('');
                            $("#ipd_id_no").val('');
                        }
                    }
                });
            });

            $("#ipd_id_no").change(function(e) {
                e.preventDefault();
                ipd_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_ipd_patients') }}",
                    data: {
                        ipd_id: ipd_id
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        console.log(response);
                        if (response.msg == 'Sucessfull') {
                            gen_table(response.ipd_list)
                            $("#opd_id_no").val('');
                        } else {
                            Swal.fire('No Records Found')
                            $('.ipd_tb_body').html('');
                            $("#opd_id_no").val('');
                        }
                    }
                });

            });

            function gen_table(list) {
                $('.ipd_tb_body').html('');
                $('.ipd_tb_body').append(` <tr>
                        <td class="px-6 py-4">
                         1
                        </td>
                        {{-- <td class="px-6 py-4">
                            {{ $patient->aid }}
                        </td> --}}
                        <td class="px-6 py-4">
                            ${list['name']}
                        </td>
                        <td class="px-6 py-4">
                            IPD
                        </td>
                        <td class="px-6 py-4">
                          ${list['adm_date']}
                        </td>
                        <td class="px-6 py-4">
                            <x-button id="btn-summary" class="bg-blue-800 btn_on_summary" value="${list['admission_id']}"
                                data-modal-target="AddPrecription" data-modal-toggle="AddPrecription">Summary</x-button>
                        </td>
                    </tr>`);
            }

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
                    url: "{{ route('rec.get_prescr') }}",
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
                        url: "{{ route('rec.insert_prescription') }}",
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
                    url: "{{ route('rec.get_pre_print') }}",
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
                summary = $(".richText-editor").html();
                console.log(id);
                $(".sum_aid").val(id);
                $(".print_sum").val(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('rec.summary') }}",
                    data: {
                        id: id,
                        summary: summary
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.msg == 'Sucessfull') {
                            $(".richText-editor").html(response.summary[0]['summary']);
                        } else if (response.msg == 'failed') {
                            $(".richText-editor").html(response.summary);
                        }
                    }
                });
            });

            $(document).on('click', '.btn_on_summary', function(e) {
                e.preventDefault();
                id = $(this).val();
                summary = $(".richText-editor").html();
                console.log(id);
                $(".sum_aid").val(id);
                $(".print_sum").val(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('rec.summary') }}",
                    data: {
                        id: id,
                        summary: summary
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#AddPrecription').removeClass('hidden');
                        $('#AddPrecription').attr('aria-hidden', 'false');
                        $('#AddPrecription').addClass('overflow-hidden');
                        if (response.msg == 'Sucessfull') {
                            $(".richText-editor").html(response.summary[0]['summary']);
                        } else if (response.msg == 'failed') {
                            $(".richText-editor").html(response.summary);
                        }
                    }
                });
            });

            $('.sub_summary').click(function(e) {
                e.preventDefault();
                id = $(".sum_aid").val();
                summary = $('.richText-editor').html();
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
                        url: "{{ route('rec.sub_sammary') }}",
                        data: {
                            id: id,
                            summary: summary
                        },
                        // dataType: "dataType",
                        success: function(response) {
                            Swal.fire("submitted successfully");
                            // setTimeout(function() {
                            //     location.reload();
                            // }, 1000);
                        }
                    });
                }
            });

            $(".summ_print").click(function(e) {
                e.preventDefault();


                var contentToPrint = $("#printable_summary").html();

                var printWindow = window.open("");
                printWindow.document.write(contentToPrint);


                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            });

            $('.print_sum').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('rec.get_sum_print') }}",
                    data: {
                        id: id
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        // console.log(response.date);
                        console.log(response);
                        if (response.msg == 'success') {
                            medicines = response.summary[0]['summary']
                            $(".brief-summ").html(medicines);
                            $('.sum_name').html(response.patient_details['name']);
                            $('.sum_opdno').html(response.patient_details['opd_number']);
                            $('.sum_regno').html(response.patient_details['ipd_no']);
                            $('.sum_age').html(response.patient_details['age']);
                            $('.sum_doc').html(response.patient_details['doctor']);
                            $('.sum_address').html(response.patient_details['address']);
                            $('.sum_dod').html(response.dis_date);
                            $('.sum_doa').html(response.admdate);
                            $('#summ_print').trigger('click');
                            $('.cls-model').trigger('click');
                        } else if (response.msg == 'failed') {
                            // $("..brief-summ").html("");
                            $('.cls-model').trigger('click');
                            Swal.fire("there is no summary")
                        }
                    }
                });

            });
        });
    </script>
</x-app-layout>
