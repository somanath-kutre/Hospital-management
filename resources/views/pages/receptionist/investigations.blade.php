<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Sl NO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Patient Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        OPD Paper No.
                    </th>

                    <th scope="col" colspan="2" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="">
                @php
                    $n = 1;
                @endphp

                @foreach ($patients as $list)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $n++ }}
                        </td>
                        <td scope="row" class="px-6 py-4 ">
                            {{ $list->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $list->id }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- {{ $list->amount }} --}}
                            <x-button class="btn_view_ptn" value="{{ $list->id }}"
                                data-patient_id="{{ $list->patient_id }}" data-admission_id="{{ $list->admission_id }}"
                                data-modal-target="view_investigation" data-modal-toggle="view_investigation">create
                            </x-button>
                        </td>
                        <td class="px-6 py-4">
                            <x-button id="view_tests" class="view_tests" value="{{ $list->id }}"
                                data-modal-target="print_tests_model"
                                data-modal-toggle="print_tests_model">View</x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-4 px-6">
            {{ $patients->links() }}
        </div>
    </div>

    <div>
        <div id="view_investigation" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full ">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Print Lab Tests
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="view_investigation">
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
                        <input type="text" id="opd_id" class='hidden'>
                        <input type="text" id="patient_id" class='hidden'>
                        <input type="text" id="admission_id" class='hidden'>

                        <div class="py-4 px-6" id="checkboxContainer" style="overflow-y: scroll;height:350px">

                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase mb-4">Ultrasonography
                                </div>
                                <div class="grid grid-cols-3 gap-2 sonography"></div>
                            </div>
                            <hr style="border:1px dashed #000000;margin:10px 0px 0px 0px">

                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase my-4">Digital X-Ray
                                </div>
                                <div class="grid grid-cols-3 gap-2 x_ray"></div>
                            </div>
                            <hr style="border:1px dashed #000000;margin:10px 0px 0px 0px">

                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase my-4">X-Ray
                                    Procedures
                                </div>
                                <div class="grid grid-cols-3 gap-2 x_ray_pro"></div>
                            </div>
                            <hr style="border:1px dashed #000000;margin:10px 0px 0px 0px">



                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase my-4">Colour Doppler
                                </div>
                                <div class="grid grid-cols-3 gap-2 color_doppler"></div>
                            </div>
                            <hr style="border:1px dashed #000000;margin:10px 0px 0px 0px">



                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase my-4">Pathology LAB
                                </div>

                                <div class=" font-bold text-md text-center text-gray-600 uppercase my-4">HEMATOLGY</div>
                                <div class="grid grid-cols-3 gap-2 hematology"></div>

                                <div class=" font-bold text-md text-center text-gray-600 uppercase my-4">BIO Chemistry
                                </div>
                                <div class="grid grid-cols-3 gap-2 bio-chem"></div>

                                <div class=" font-bold text-md text-center text-gray-600 uppercase my-4">SERLOGY</div>
                                <div class="grid grid-cols-3 gap-2 serology"></div>

                                <div class=" font-bold text-md text-center text-gray-600 uppercase my-4">CLINICAL PATH
                                </div>
                                <div class="grid grid-cols-3 gap-2 clnc-path"></div>

                                <div class=" font-bold text-md text-center text-gray-600 uppercase my-4">Special Test
                                </div>
                                <div class="grid grid-cols-3 gap-2 spl-path"></div>
                            </div>
                            <hr style="border:1px dashed #000000;margin:10px 0px 0px 0px">


                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase my-4">OPG
                                </div>
                                <div class="grid grid-cols-2 gap-1 opg"></div>
                            </div>

                            <div>
                                <div class=" font-bold text-xl text-center text-gray-400 uppercase my-4">CT Scan
                                </div>
                                <div class="grid grid-cols-2 gap-1 ct_scan"></div>
                            </div>


                        </div>
                    </div>
                    <div class="py-6 px-6 font-bold text-2xl">
                        <x-button id="btn-sub-chks">Submit</x-button>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div>
        <div id="print_tests_model" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full ">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            All Investigations
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="print_tests_model">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
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
                                        Category
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
                    <div>

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
    <div class="test_to_be_print hidden" style="width:100%">

    </div>

    <div class="hidden final_tests_table">

        <x-papers.labtest />
    </div>




    <script src="{{ asset('js/investigation_list.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function() {

            // hgt = $('body').height();
            // $("#checkboxContainer").height(hgt/0.5);

            const categoryClassMap = {
                'ULTRASONOGRAPHY': '.sonography',
                'DIGITAL X-RAY': '.x_ray',
                'HEMATOLOGY': '.hematology',
                'BIOCHEMISTRY': '.bio-chem',
                'SEROLOGY': '.serology',
                'CLINICAL PATH': '.clnc-path',
                'SPECIAL TEST': '.spl-path',
                'CT SCAN': '.ct_scan',
                'COLOUR DOPPLER': '.color_doppler',
                'X-RAY PROCEDURE': '.x_ray_pro',
                'OPG': '.opg'
            };

            $.each(list, function(ind, val) {
                const categoryClass = categoryClassMap[val.category];
                if (categoryClass) {
                    $(categoryClass).append(`
            <div>
                <input type="checkbox" value="${val.id}" data-department="${val.department}" data-category="${val.category}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-checkbox" class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">${val.label}</label>
            </div>`);
                }
            });

            $('.btn_view_ptn').click(function(e) {
                e.preventDefault();
                var patient_id = $(this).data('patient_id');
                var admission_id = $(this).data('admission_id');
                var id = $(this).val();

                $('#opd_id').val(id);
                $('#admission_id').val(admission_id);
                $('#patient_id').val(patient_id);
                // console.log(id,patient_id);
            });

            $("#btn-sub-chks").click(function(e) {
                e.preventDefault();

                var checkedCheckboxesArray = [];
                // Iterate through each checkbox

                if (!opd_id || !patient_id || !admission_id) {
                    // Handle case when opd_id, patient_id, or admission_id is missing
                    console.error('opd_id, patient_id, or admission_id is missing');
                    return;
                }

                $('#checkboxContainer input[type="checkbox"]').each(function() {
                    if ($(this).prop('checked')) {
                        var opd_id = $('#opd_id').val();
                        var patient_id = $('#patient_id').val();
                        var admission_id = $('#admission_id').val();
                        var checkboxValue = $(this).val();
                        var checkboxLabel = $(this).next('label').text();
                        var checkboxCategory = $(this).data('category');
                        var checkboxDepartment = $(this).data('department');


                        // Create an object and push it to the array
                        checkedCheckboxesArray.push({
                            // id: checkboxValue,
                            opd_id: opd_id,
                            patient_id: patient_id,
                            admission_id: admission_id,
                            test_name: checkboxLabel,
                            category: checkboxCategory,
                            department: checkboxDepartment,
                        });
                    }
                });
                // Display the array in the console (you can remove this line)

                console.log(checkedCheckboxesArray);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('rec.insert_test') }}",
                    data: {
                        test: checkedCheckboxesArray
                    },
                    success: function(response) {
                        if (response.msg === 'no tests') {
                            Swal.fire('NO TEST TO INSERT');
                        }
                        if (response.msg === 'SuccessFull') {
                            Swal.fire('Inserted Successfully');
                            location.reload();
                        }
                    }
                });
            });

            function fill_table(list, list2) {
                $('.name').html(list2[0]['name']);
                $('.age').html(list2[0]['age']);
                $('.gender').html(list2[0]['gender']);
                $('.phone').html(list2[0]['phone']);

                $('.tests_table').html('');
                sl = 1
                if (list === 'not test found') {
                    $('.tests_table').html(
                        '<h1 class="text-center text-2xl text-red-900"> There are no tests</h1>');
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
                                            ${val.category}
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
                            `<tr><td style="padding:10px;border:1px solid #000000;font-weight:bold">${val.test_name}</td></tr>`
                        );
                    });

                }
            }

            $(".view_tests").click(function(e) {
                e.preventDefault();
                opd_id = $(this).val();
                console.log(opd_id);
                $('.btn-prt-lablist').val(opd_id);


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
                        fill_table(list, p_list);
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
                        fill_table(list, p_list);
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
        });
    </script>
</x-app-layout>
