<x-app-layout>


    <div class="recipt_section">
        <div class="py-4 px-6 font-bold text-2xl">Recipts</div>
        <div class="py-4 px-6">
            <div class="grid grid-cols-2 gap-4">

                <div class="phone">
                    <x-label for="" value="{{ __('Search Recipts By OPD NO') }}" />
                    <x-input id="find_opd" class="w-full" placeholder="Enter OPD Number" />
                </div>
                {{-- <div class="phone">
                    <x-label for="" value="{{ __('Search Recipts By IPD NO') }}" />
                    <x-input id="find_ipd" class="w-full" placeholder="Enter IPD Number" />
                </div> --}}
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            sl No.
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                       Admission Serial No.
                    </th> --}}
                        <th scope="col" class="px-6 py-3">
                            Patient Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            opd / case paper NO
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            Date
                        </th> --}}
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="main_table">
                    @php
                        $n = 0;
                    @endphp
                    @foreach ($data as $list)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $n = $n + 1 }}

                            </td>
                            {{-- <td class="px-6 py-4">
                            {{ $list->id }}
                        </td> --}}
                            <td class="px-6 py-4">
                                {{ $list->name }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                {{ $list->admission_type }}

                            </td> --}}
                            <td class="px-6 py-4">

                                {{ $list->opd_number }}
                            </td>
                            <td class="px-6 py-4">
                                <x-button class="btn_vw_bills" value="{{ $list->opd_number }}"
                                    data-modal-target="AddbillModal" data-modal-toggle="AddbillModal">View</x-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-5 pagi_div">
                {{ $data }}
            </div>
         
        </div>

        <div>
            <div id="AddbillModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                style="background-color: #a5bcff59;">
                <div class="relative w-full max-w-3xl max-h-full main_model">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                All Bills
                            </h3>
                            <button type="button"
                                class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                        <div class="p-4">
                            <input type="text" id="a_id" class='hidden'>

                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            sl No
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3">
                                        Reg/Case Paper No
                                    </th> --}}
                                        {{-- <th scope="col" class="px-6 py-3">
                                            Bill No
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3">
                                            Recipt No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bills_table">
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="hidden recipt_body">
            <x-papers.new_recipt />
        </div>
    </div>

    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        function handleNumericInput(inputId, maxLength) {
            $(inputId).on('input', function() {
                const input = $(this).val().replace(/\D/g, '').substring(0, maxLength);
                $(this).val(input);
            });
        }
        handleNumericInput('#find_ipd', 6);
        handleNumericInput('#find_opd', 6);
    </script>

    <script>
        $(document).ready(function() {

            function fill_table(id) {
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_bills') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        bills = response.bills;
                        $(".bills_table").html('');
                        n = 0;
                        $.each(bills, function(ind, val) {

                            $(".bills_table").append(`<tr>
                                <td 
                                    class="px-6 py-4">
                                    ${n = n + 1}
                                </td>
                                
                                <td class="px-6 py-4">
                                    ${val.i_id}
                                </td>
                                <td class="px-6 py-4">
                                    ${val.descr}
                                </td>
                                <td class="px-6 py-4">
                                    ${val.admission_type}
                                </td>
                                <td class="px-6 py-4">
                                    ${val.date}
                                </td>
                                <td class="px-6 py-4">
                                    <x-button value="${val.i_id}" class="btn_prt_bill">Print</x-button>
                                </td>                                   
                            </tr>`);
                        });
                    }
                });
            }

            function fill_bill(id) {
                // console.log(bills);
                $.each(bills, function(ind, val) {
                    if (val.i_id == id) {
                        $('.bill_no').html(val.i_id);
                        $('.p_id').html(val.p_id);
                        $('.bill_date').html(val.date);
                        $('.p_name').html(val.name);
                        $('.p_mode').html(val.p_mode);
                        $('.opd_id').html(val.opd_number);
                        $('.b_amount').html(`${val.amount} /-`);
                        $('.amt_in_words').html(`${val.amt_in_words} only`);
                        $('.b_descr').html(`${val.descr}.`);

                        if(val.descr === 'OPD Consultation' || val.descr === 'Consultation'){
                            $(".valid_div").show();
                        }
                        else{
                            $(".valid_div").hide();
                        }
                    }
                });
            }

            $('.btn_vw_bills').click(function(e) {
                e.preventDefault();
                id = $(this).val();
                $('#a_id').val(id);
                fill_table(id)
            });

            $(document).on('click', '.btn_vw_bills', function(e) {
                e.preventDefault();
                id = $(this).val();
                console.log(id);
                $('#a_id').val(id);
                fill_table(id);

                $('#AddbillModal').removeClass('hidden');
                $('#AddbillModal').attr('aria-hidden', 'false');
                $('#AddbillModal').addClass('overflow-hidden');
                $('.main_model').attr('style','position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);');     
            })



            $(document).on('click', '.btn_prt_bill', function(e) {
                e.preventDefault();
                id = $(this).val();
                fill_bill(id);

                var html = $('.recipt_body').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.print();
                printWindow.close();
                // $('.close-pop').trigger('click');
            });

            $("#find_opd").change(function(e) {
                e.preventDefault();
                opd_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_rcpt_opdid') }}",
                    data: {
                        opd_id: opd_id
                    },
                    success: function(response) {
                        console.log(response.data);
                        msg = response.msg;
                        if (msg === 'error') {
                            Swal.fire(`There is no patient of  <br> OPD ID:${opd_id}`);
                        }
                        if(msg === 'nobills'){
                            Swal.fire(`There are no recipts of patient   <br> OPD ID:${opd_id}`);
                        }
                        if (msg == 'success') {
                            fetched_list = response.patient_data;
                            console.log(fetched_list);
                            sn = 1;
                            $('.main_table').html('');
                            $('.pagi_div').html('');
                            $.each(fetched_list, function(ind, val) {
                                $(".main_table").append(` <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                              ${sn++}
                            </td>
                            <td class="px-6 py-4">
                           ${val.name}
                            </td>
                            <td class="px-6 py-4">
                           ${val.opd_number}
                            </td>
                            <td class="px-6 py-4">
                                <x-button class="btn_vw_bills" value="${val.opd_number}"
                                    data-modal-target="AddbillModal" data-modal-toggle="AddbillModal">View</x-button>
                            </td>
                        </tr>`);
                            });

                        }
                    }
                });
            });

           

        });
    </script>
</x-app-layout>
