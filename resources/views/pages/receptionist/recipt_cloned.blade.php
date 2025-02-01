<x-app-layout>
    <div class="p-4">
        <div class="text-xl mb-4">
            Create recipts

        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <x-label for="p_method" value="{{ __('OPD Number') }}" style="margin-bottom: 5px" />
                <x-input type="number" name="opd_number" class="w-full" id="opd_number" placeholder="Enter OPD Number" />
            </div>
            <div>
                <x-label for="" value="{{ __('Bill Number') }}" />
                <x-select id="a_id" name="a_id" class="a_id" :title="'Select Bill number'" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 recitpt_sumbit my-4 ">
            <div>
                <x-label for="p_method" value="{{ __('Name') }}" />
                <x-input type="text" name="name" class="w-full" id="name" placeholder="" disabled />
            </div>
            <div>
                <x-label for="p_method" value="{{ __('Amount') }}" />
                <x-input type="number" name="amount" class="w-full" id="amount" placeholder="Enter amount" />
            </div>
            <div>
                <x-label for="p_method" value="{{ __('Description') }}" />
                <x-input type="text" name="descr" class="w-full" id="descr" placeholder="Enter description" />
            </div>
            <div>
                <x-label for="p_method" value="{{ __('Payment Method') }}" />
                <x-select id="p_method" name="p_method" :title="'Select Payment Method'" :options="['cash' => 'CASH', 'upi' => 'UPI']" />

            </div>
            <div>
                <x-button id="btn_save">Save</x-button>
            </div>
        </div>
    </div>

    <div class="p-4">
        <input type="text" id="a_id" class='hidden'>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead
                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        sl 
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Case Paper 
                </th>
                    <th scope="col" class="px-6 py-3">
                        Bill No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Recipt
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
        <div class="hidden recipt_body">
            <x-papers.new_recipt />
        </div>
    </div>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".recitpt_sumbit").hide();

            $("#opd_number").change(function(e) {
                e.preventDefault();
                opd_id = $(this).val();

                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_bills') }}",
                    data: {
                        id: opd_id
                    },
                    success: function(response) {
                        bills = response.bills[0];
                        console.log(bills);
                        console.log(response);

                        if (bills == undefined) {
                            Swal.fire(`There are no previous records`)
                            $('#a_id').empty()
                            $(".recitpt_sumbit").hide();
                            $(".bills_table").html('');
                        } else {
                            $(".recitpt_sumbit").show();
                            name = response.bills[0]['name']
                            list = response.bills;
                            $('#a_id').empty()
                            $.each(list, function(ind, val) {
                                $('#a_id').append($('<option>', {
                                    value: val.a_id,
                                    text: val.a_id
                                }));
                            });
                            $("#name").val(name);
                            $("#amount").val('');
                            $("#descr").val('');
                            recipts = response.cloned_recipts;
                            fill_table(recipts);
                            
                        }
                    }
                });
            });

            function fill_bill(id) {
                // console.log(bills);
                $.each(recipts, function(ind, val) {
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

           function fill_table(list){
            $(".bills_table").html('');
            n = 0;
            $.each(list, function (ind, val) { 
                $(".bills_table").append(`<tr>
                                <td 
                                    class="px-6 py-4">
                                    ${n = n + 1}
                                </td>

                                <td class="px-6 py-4">
                                    ${val.opd_number}
                                </td>
                                
                                <td class="px-6 py-4">
                                    ${val.a_id}
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

            $("#btn_save").click(function(e) {
                e.preventDefault();
                opd_id = $("#opd_number").val();
                a_id = $("#a_id").val();
                amount = $("#amount").val();
                descr = $("#descr").val();
                p_method = $("#p_method").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{route('rec.insert_clone_rec')}}",
                    data: {
                        admission_id : a_id,
                        opd_number : opd_id,
                        amount : amount,
                        p_mode : p_method,
                        descr : descr,
                    },
                    success: function (response) {
                        console.log(response);
                        recipts = response.recipts;
                        fill_table(recipts);

                    }
                });

                // console.log(opd_id, a_id, amount, descr, p_method);
            });

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
        });
    </script>
</x-app-layout>
