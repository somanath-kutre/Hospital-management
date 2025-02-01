<x-app-layout>
    <div class="p-4 text-xl">
       All Bills
    </div>
    <div class="p-4">
        <div class="grid grid-cols-2">
            <div>
                <x-label for="" value="{{ __('OPD Number') }}" />
                <x-input type="number" id="opd_id_no" name="opd_id_no" class="block mt-1 w-full" placeholder="Search bill by OPD number"
                    inputmode="numeric" />
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Bill no
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Patient Name
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        OPD No
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        discharge date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        action
                    </th>
                </tr>
            </thead>
            <tbody class="main_tb_body">
                @php $n = 1; @endphp
                @foreach ($patients as $patient)
                    <tr>
                        <td class="px-6 py-4">{{ $patient->aid }}</td>
                        <td class="px-6 py-4">{{ $patient->patient_name }}</td>
                        <td class="px-6 py-4">{{ $patient->discharge_date }}</td>
                        <td class="px-6 py-4"> <x-button class="btn_print"
                                style="background-color: #1665342e;color: green;border: 1px solid green;"
                                value="{{ $patient->aid }}" data-modal-target="staticModal"
                                data-modal-toggle="staticModal">
                                {{ __('View') }}
                            </x-button></td>
                    </tr>
                @endforeach
            </tbody>
            <tbody class="opd_bills_tb">

            </tbody>
        </table>
        <div class="nav_links">
            {{ $patients->links() }}
        </div>
        
    </div>

    <div>
        <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="    background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full ">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Patient Bill Deatils
                        </h3>
                        <button type="button"
                            class="cls-model text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                    {{-- <div class="p-6 space-y-6" id="printableContent">
                        <div class="hidden">
                            <table style="margin-bottom:30px">
                                <tr>
                                    <th colspan="3" class="center">
                                        <h1>ASHWINI HOSPITAL</h1>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" style="text-align: center;">SHIVE SAGAR ARCADE 1264, RAMLINGKHIND
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

                        <div class="hidden">
                            <div>
                                <h3 class="">Patient Details</h3>
                            </div>
                            <table style="">

                                <tr>
                                    <td class="bold p_regno" colspan="2">Reg No: <strong>1234</strong></td>
                                </tr>
                                <tr>
                                    <td class="bold p_name"></td>
                                    <td class="bold p_admission">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bold p_address">Address: <strong>${paddress}</strong></td>
                                    <td class="bold p_discharge">
                                        D.O.D: <strong>${pdischarge}</strong>
                                    </td>
                                </tr>
                            </table>

                            <div>
                                <h3 class="">Hospital Bill</h3>
                            </div>
                        </div>
                        <div class="patient">
                            <div class="">
                                <table class="w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="py-2 px-4 text-left">Description</th>
                                            <th class="py-2 px-4 text-left">Quantity</th>
                                            <th class="py-2 px-4 text-left">Unit Price</th>
                                            <th class="py-2 px-4 text-left">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="hospital_bills">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-4 text-left " colspan="4" style="font-weight: bold">Iv Fluids And Injections</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="medicine_bills">
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-bold bold"
                                                style="font-weight: bold">Total Bill: </td>
                                            <td class="py-2 px-4 font-semibold total"></td>
                                        </tr>
                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-bold bold"
                                                style="font-weight: bold">Diccount: </td>
                                            <td class="py-2 px-4 font-semibold dis_amt"></td>
                                        </tr>
                                        <tr class="bg-gray-200">
                                            <td colspan="3" class="py-2 px-4 text-right font-bold bold"
                                                style="font-weight: bold">Paid Amount: </td>
                                            <td class="py-2 px-4 font-semibold paid_amt"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="patient_details"></div>
                            <div class="grid grid-cols-3 gap-4 billing_details">
                            </div>
                        </div>
                    </div> --}}
                    <div class="p-6 space-y-6" id="printableContent">

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bill_table">

                            </tbody>
                        </table>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="staticModal" type="button" id="confirm_print"
                            class="confirm_print text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden">
        <div class="bills_content">
            <x-papers.bill />
        </div>
    </div>

    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            function fill_bills(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('rec.get_to_print_final') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        inj_iv_count = response.cat_count
                        bills = response.bill;
                        p_data = response.patient_data;
                        // console.log();
                        $('.bill_table').html('');
                        $.each(response.bill, function(ind, val) {
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
                        $('.p_discharge').html(p_data[0]['updated_at']);

                        $(".paid_in_words").html(response.paid_in_words);
                        $(".tot_amt").html(response.total_amt);
                        $(".dis_amt").html(response.dis_amount);
                        $(".rec_amt").html(response.net_amt);
                        $('.adv_amt').html(response.advance);
                        $('.p_regno').html(id);
                        dis_text = $(".dis_amt").html();
                        if (dis_text === '') {
                            $('.dis_amt_sec').hide();
                        } else {
                            $('.dis_amt_sec').show();
                        }
                    }
                });
            }

            $('.btn_print').click(function(e) {
                e.preventDefault();
                var id = $(this).val();
                $('#confirm_print').val(id);
                fill_bills(id);
            });

            $(document).on('click', '.btn_print_on', function(e){
                e.preventDefault();
                var id = $(this).val();
                $('#confirm_print').val(id);
                fill_bills(id);

                $('#staticModal').removeClass('hidden');
                $('#staticModal').attr('aria-hidden', 'false');
                $('#staticModal').addClass('overflow-hidden');
            })

            $('.confirm_print').click(function(e) {
                e.preventDefault();
                var prt_id = $(this).val();
                console.log(bills);
                $('.hospital_bills').html('');
                $('.iv_fluids_bill').html('');
                $.each(bills, function(ind, val) {
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
                    $.each(bills, function(ind, val) {
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
                location.reload();
            });

            $("#opd_id_no").change(function (e) { 
                e.preventDefault();
                opd_id = $(this).val();
           
                $.ajax({
                    type: "get",
                    url: "{{route('rec.get_bills_opd')}}",
                    data: {
                        opd_id:opd_id
                    },
                    success: function (response) {
                        console.log(response);
                        msg = response.msg
                        if(msg === 'success'){
                            $(".main_tb_body").hide();
                            $(".nav_links").hide();
                            $(".opd_bills_tb").show();
                            list = response.data;
                            $(".opd_bills_tb").html('');
                            $.each(list, function (ind, val) { 
                                 $(".opd_bills_tb").append(`
                                 <tr>
                        <td class="px-6 py-4">${val.aid}</td>
                        <td class="px-6 py-4">${val.patient_name}</td>
                        <td class="px-6 py-4">${val.discharge_date}</td>
                        <td class="px-6 py-4"> <x-button class="btn_print_on"
                                style="background-color: #1665342e;color: green;border: 1px solid green;"
                                value="${val.aid}" data-modal-target="staticModal"
                                data-modal-toggle="staticModal">
                                {{ __('View') }}
                            </x-button></td>
                    </tr>`);
                            });
                        }
                        if(msg === 'Error'){
                            swal.fire(`No Bills Available With OPD Number: ${opd_id}`);
                            $(".main_tb_body").show();
                            $(".nav_links").show();  
                            $(".opd_bills_tb").hide();
                        }
                    }
                });

            });

        });
    </script>

</x-app-layout>
