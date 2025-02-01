<x-app-layout>
    <style>
        .bold {
            font-weight: bold
        }

        .b-500 {
            font-weight: 500;
        }

        .b-600 {
            font-weight: 600;
        }

        .collapse {
            border-collapse: collapse;
        }

        .border-full {
            border: 1px solid #000000;
        }

        .small {
            font-size: 14px;
        }

        .title {
            font-size: 24px
        }

        .less-padding {
            padding: 5px 20px;
        }

        .center {
            text-align: center
        }

        .underlined {
            text-decoration: underline
        }

        .r-border {
            border-right: 1px solid #000000;
        }

        .margin-5 {
            margin: 5px 0px
        }
    </style>
    <div class="hidden">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center ipd_paper_tabs" id="myTab"
                data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="#" data-tabs-target="#note-adv" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Notes & Advice</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="#" data-tabs-target="#ipd_cp" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">IPD Case Paper</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="#" data-tabs-target="#con-form"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Consent
                        form</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="#" data-tabs-target="#inf_con" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Informed Consent</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="#" data-tabs-target="#op-note" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Operation Notes</button>
                </li>



            </ul>
        </div>

        <div id="myTabContent">

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="ipd_cp" role="tabpanel"
                aria-labelledby="profile-tab">
                {{-- <x-button id="btn-ipd-cp" class="bg-teal-900 mt-5"> Print IPD Case Paper</x-button> --}}
                <div class="py-5 my-5 bg-gray-400">
                    <x-papers.new_ipdcasepaper />
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="inf_con" role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="py-5 my-5 bg-gray-400">
                    <x-papers.informed_consent />
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="con-form" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <div class="my-5 bg-gray-400">
                    <x-papers.consent-form />
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="op-note" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <div class="my-5 bg-gray-400">
                    <x-papers.operation_notes />
                </div>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="note-adv" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <div class="my-5 bg-gray-400">
                    <x-papers.notes_advice />
                </div>
            </div>
        </div>
    </div>

    <div class="ipd_section">
        <div class="p-6 font-bold text-2xl">
            IPD Papers
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Patient Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            IPD Case paper
                        </th>
                        <th scope="col" class="px-6 py-3">
                            consent form
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Operation notes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Informed Consent
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Notes and advice
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Blood sugar chart
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Inpatient Record
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Investigation Report
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($list as $data)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data->patient_name }}
                            </th>
                            <td class="px-6 py-4">
                                <x-button id="btn-ipd-cp" class="bg-teal-900 btn-ipd-cp"
                                    value="{{ $data->aid }}">Print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-consent" class="bg-teal-900 btn-consent"
                                    value="{{ $data->aid }}">Print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-ot-nte" class="bg-teal-900 btn-ot-nte"
                                    value="{{ $data->aid }}">Print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-inf-con" class="bg-teal-900 btn-inf-con"
                                    value="{{ $data->aid }}">print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-nte-adv" class="bg-teal-900 btn-nte-adv"
                                    value="{{ $data->aid }}">print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-blood_sugar" class="bg-teal-900 btn-blood_sugar"
                                    value="{{ $data->aid }}">print</x-button>
                            </td>

                            <td class="px-6 py-4"><x-button id="btn-ipd_record" class="bg-teal-900 btn-ipd_record"
                                    value="{{ $data->aid }}">print</x-button></td>

                                    <td class="px-6 py-4"><x-button id="btn-iv_record" class="bg-teal-900 btn-iv_record"
                                        value="{{ $data->aid }}">print</x-button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="opd_section">
        <div class="p-6 font-bold text-2xl">
            OPD Papers
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Patient Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            OPD Case paper
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Appointment Letter
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($opd_data as $data)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data->patient_name }}
                            </th>
                            <td class="px-6 py-4">
                                <x-button id="btn-opd-cp" class="bg-teal-900 btn-opd-cp"
                                    value="{{ $data->aid }}">Print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-opd-cp" class="bg-teal-900 apptmnt"
                                    value="{{ $data->aid }}">Print</x-button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-5">
                {{-- {{ $opd_data->links() }} --}}
            </div>

        </div>
    </div>

    <div>
        <div class="p-6 font-bold text-2xl">
            Generate OPD Papers
            <div class="grid mt-2 grid-cols-2 gap-2">
                <div>
                    <x-label for="bill" value="{{ __('OPD Number') }}" />
                    <x-input id="opd_id" class="block mt-1 w-full opd_id" type="number"
                        placeholder="Enter the OPD Number" required />
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Patient Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                OPD Case paper
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Appointment Letter
                            </th>
                        </tr>
                    </thead>
                    <tbody class="s_opd_table">
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <div class="hidden ipd_record">
        <x-papers.ipd_record />
    </div>

    <div class="blod_sugar hidden">
        <x-papers.blood_sugar />
    </div>

    <div class="opd_paper hidden">
        <x-papers.new_opdcasepaper />
    </div>


    <div class="appoint_paper hidden">
        <x-papers.appoint />
    </div>

    <div class="investigation_paper_sec hidden">
        <x-papers.investigation_reports />
    </div>

    {{-- <script src="{{ asset('./js/jquery.js') }}"></script> --}}
    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function() {

            patient_data = <?php echo $list; ?>;

            opd_data = <?php echo $opd_data; ?>;

            //    paginated_opd = @json($opd_data);
            //    console.log(paginated_opd['data']);

            // console.log(opd_data, patient_data);


            html =
                `<html><head><style>@page{margin:4mm}@media print{.neg-top{margin-top:-15px;}.bold{font-weight: bold}.b-500{font-weight:500;}.b-600{font-weight:600;}.collapse {border-collapse: collapse;}.border-full {border: 1px solid #000000;}.small{font-size: 14px;}.title{font-size: 24px}.less-padding {padding: 5px 20px;}.center{text-align: center}.r-border{border-right:1px solid #000000;}.underlined{text-decoration: underline}.margin-5{margin: 5px 0px}.padding-tb-small{padding: 5px 0px;}}</style></head><body>`;

            function fill_data(id, list) {
                $.each(list, function(ind, val) {
                    if (val.aid == id) {
                        $('.ip_reg_no').html(val.aid);
                        $('.opd_no').html(val.opd_no);
                        $('.p_id').html(val.p_id);
                        $('.ipd_no').html(val.ipd_no);
                        $('.ip_ptname').html(val.patient_name);
                        $('.ip_date_op').html(val.formatted_op_date);
                        $('.ip_time_adm').html(val.admission_time);
                        $('.ip_age').html(val.p_age);
                        $('.ip_phone').html(val.phone);
                        $('.ip_hus_father_nm').html(val.household);
                        $('.ip_operation').html(val.op_name);
                        $('.ip_gender').html(val.gender);
                        $('.ip_address').html(val.address);
                        $('.ip_date_adm').html(val.admission_date);
                        $('.ip_refr_dr').html(`Dr. ${val.referal}`);
                        // // $('.ip_date_op').val();
                    }
                });
            }


            function fill_data_two(id, list) {
                $.each(list, function(ind, val) {
                    if (val.aid == id) {
                        $('.opd_no').html(val.opd_no);
                        $('.p_id').html(val.p_id);
                        $('.ip_ptname').html(val.patient_name);
                        $('.ip_age').html(val.p_age);
                        $('.ip_phone').html(val.phone);
                        $('.ip_gender').html(val.gender);
                        $('.ip_address').html(val.address);
                        $('.ip_date_adm').html(val.admission_date);
                        $('.ip_refr_dr').html(`Dr. ${val.referal}`);
                        // // $('.ip_date_op').val();
                    }
                });
            }

            $('.btn-consent').click(function(e) {
                e.preventDefault();

                id = $(this).val();
                fill_data(id, patient_data);
                print_consent_form();

                function print_consent_form() {
                    content = $(".consent-form").html();
                    var printWindow = window.open("");
                    printWindow.document.write(html);
                    printWindow.document.write(content);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }

            });

            $('.btn-inf-con').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_data(id, patient_data);
                print_informed_consent();

                function print_informed_consent() {
                    var informed = $('.informed-consent').html();
                    var printWindow = window.open("");
                    printWindow.document.write(html);
                    printWindow.document.write(informed);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });

            $('.btn-ipd-cp').click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                fill_data(id, patient_data);
                print_case_paper();

                function print_case_paper() {
                    var ipd_cp = $('.ipd_case_paper').html();
                    var printWindow = window.open("");
                    printWindow.document.write(html);
                    printWindow.document.write(ipd_cp);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });



            $('.btn-ot-nte').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_data(id, patient_data);
                print_operation_notes();

                function print_operation_notes() {
                    var ot_notes = $('.operation_notes').html();
                    var printWindow = window.open("");
                    printWindow.document.write(html);
                    printWindow.document.write(ot_notes);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }

            });

            $('.btn-nte-adv').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_data(id, patient_data);
                print_note_advice();

                function print_note_advice() {
                    var notes_advice = $('.notes_advice').html();
                    var printWindow = window.open("");
                    printWindow.document.write(html);
                    printWindow.document.write(notes_advice);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });

            $('.btn-ipd_record').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_data(id, patient_data);
                var ipd_record = $('.ipd_record').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.document.write(ipd_record);
                printWindow.document.write(`</body></html>`);
                printWindow.print();
                printWindow.close();
            });

            $('.btn-blood_sugar').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_data(id, patient_data);
                var blod_sugar = $('.blod_sugar').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.document.write(blod_sugar);
                printWindow.document.write(`</body></html>`);
                printWindow.print();
                printWindow.close();
            });

            $('.btn-opd-cp').click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                console.log(id);
                fill_data(id, opd_data);
                print_opd_paper();

                function print_opd_paper() {
                    var opd_cp = $('.opd_paper').html();
                    var printWindow = window.open("");
                    printWindow.document.write(opd_cp);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });
            $('.btn-iv_record').click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                console.log(id);
                fill_data(id, patient_data);
                print_opd_paper();

                function print_opd_paper() {
                    var opd_cp = $('.investigation_paper_sec').html();
                    var printWindow = window.open("");
                    printWindow.document.write(opd_cp);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });
           
            $('.apptmnt').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_data(id, opd_data);
                print_apt_letter();

                function print_apt_letter() {
                    var appt = $('.appoint_paper').html();
                    var printWindow = window.open("");
                    printWindow.document.write(appt);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });

            $(document).on('click', '.apptmnt_two', function(e) {
                e.preventDefault();
                id = $(this).val();
                print_apt_letter();

                function print_apt_letter() {
                    var appt = $('.appoint_paper').html();
                    var printWindow = window.open("");
                    printWindow.document.write(appt);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            })

            $(document).on('click', '.btn-opd-cp_two', function(e) {
                e.preventDefault();
                var id = $(this).val();
                print_opd_paper();

                function print_opd_paper() {
                    var opd_cp = $('.opd_paper').html();
                    var printWindow = window.open("");
                    printWindow.document.write(opd_cp);
                    printWindow.document.write(`</body></html>`);
                    printWindow.print();
                    printWindow.close();
                }
            });


            $("#opd_id").change(function(e) {
                e.preventDefault();
                opd_id = $(this).val();
                console.log(opd_id);

                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_opdpaper') }}",
                    data: {
                        opd_id: opd_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.msg === 'error') {
                            Swal.fire('Dont Exist');
                        }
                        if (response.msg === 'success') {
                            $(".opd_section").html('');
                            $(".ipd_section").html('');

                            p_data = response.data[0];
                            list = response.data;
                            aid = p_data['aid'];
                            // console.log(list,aid);
                            fill_data_two(aid, list)
                            $('.s_opd_table').html('');
                            $('.s_opd_table').append(`<tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                             ${p_data['patient_name']}
                            </th>
                            <td class="px-6 py-4">
                                <x-button id="btn-opd-cp" class="bg-teal-900 btn-opd-cp_two"
                                    value=" ${p_data['aid']}">Print</x-button>
                            </td>
                            <td class="px-6 py-4">
                                <x-button id="btn-opd-cp" class="bg-teal-900 apptmnt_two"
                                    value=" ${p_data['aid']}">Print</x-button>
                            </td>
                        </tr>`);
                        }
                    }
                });
            });

        });
    </script>
</x-app-layout>
