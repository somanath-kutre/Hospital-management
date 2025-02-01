<x-app-layout>
    {{-- {{$new}} --}}
    <div class="daily_reps">
        <div class="py-4 px-6 font-bold text-2xl">Daily Reports</div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Patient Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Reg/Case Paper No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Professional Services
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fees Recieved
                        </th>
                    </tr>
                </thead>
                <tbody class="">

                    @foreach ($data as $list)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $list->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $list->opd_number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $list->descr }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $list->amount }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="daily_reps">
        <div class="py-4 px-6 font-bold text-2xl">Generate Reports</div>
        <div class="grid grid-cols-2 gap-4 py-4 px-6">
            <div>
                <div class="">
                    <x-label for="name" value="{{ __('From') }}" />
                    <x-input id="f_date" class="block mt-1 w-full" type="date" name="f_date"
                        placeholder="Select Date" />
                </div>
            </div>
            <div>
                <div class="">
                    <x-label for="name" value="{{ __('To') }}" />
                    <x-input id="t_date" class="block mt-1 w-full" type="date" name="t_date"
                        placeholder="Select Date" />
                </div>
            </div>
            <div>
                <x-button id="sub_date">Generate Report</x-button>
                <x-button class="bg-red-800" id="btn_prnt_report">Print</x-button>
            </div>
            <div></div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="height: 350px;overflow-y:scroll">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Patient Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Reg/Case Paper No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Professional Services
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fees Recieved
                        </th>
                    </tr>
                </thead>
                <tbody class="fetched_bills">


                </tbody>
            </table>
        </div>
    </div>

    <div class="print_div hidden" style="width: 100%">
        <x-papers.reports_temp />
    </div>



    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $("#sub_date").click(function(e) {
            e.preventDefault();

            f_date = $("#f_date").val();
            t_date = $("#t_date").val();
            console.log(f_date, t_date);

            function fill_table(list,tot_amt) {
                $(".fetched_bills").html('');
                $.each(list, function(ind, val) {
                    $(".fetched_bills").append(`   <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${val.name}
                            </td>
                            <td class="px-6 py-4">
                                ${val.opd_number}
                            </td>
                            <td class="px-6 py-4">
                                ${val.descr}
                            </td>
                            <td class="px-6 py-4">
                                ${val.amount}
                            </td>
                        </tr>`);
                });

            //     $('.prt_body').html('');
            //     sl = 1;
            //     $.each(list, function(ind, val) {
            //         $(".prt_body").append(`<tr>
            //     <td>${sl++}</td>
            //     <td>${val.name}</td>
            //     <td>${val.id}</td>
            //     <td>${val.descr}</td>
            //     <td>${val.amount}</td>
            // </tr>`);
            //     });


                var tableCounter = 1;
                $('.main_table_div').html('');
                $.each(list, function(ind, val) {
                    // Check if the current index is a multiple of 8 to create a new table
                    if (ind % 28 === 0 && ind !== list.length - 1) {
                        // Create a new table and update the counter
                        $(".main_table_div").append(
                            `<table class="prt_table"> 
                                <thead class="">
                                    <tr>
                                        <th>DATE</th>
                                        <th>PATIENT NAME</th>
                                        <th>OPD No</th>
                                        <th>Recipt No</th>
                                        <th>SERVICES</th>
                                        <th>FEES</th>
                                    </tr>
                                 </thead>
                                 <tbody class="prt_body${tableCounter}">
                                </tbody>
                                 <tfoot class="prt_footer${tableCounter}">
                                </tfoot>
                            </table>`
                        );
                        tableCounter++;
                    }

                    // Append the row to the current table (updated the tableCounter here)
                    $(".prt_body" + (tableCounter - 1)).append(
                        `<tr>
                            <td>${val.recipt_date}</td>
                            <td>${val.name}</td>
                            <td>${val.opd_number}</td>
                            <td>${val.recipt_no}</td>
                            <td>${val.descr}</td>
                            <td>${val.amount}</td>
                        </tr>`
                    );
                });

                $(".prt_body" + (tableCounter - 1)).after(
                        `<tfoot>
                            <tr>
                                <td colspan="5" style="text-align: right;"><b>Total:</b></td>
                                <td>${tot_amt}</td>
                            </tr>
                        </tfoot>`
                    );

            }

            if (f_date !== '' && t_date !== '') {
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_reports') }}",
                    data: {
                        f_date: f_date,
                        t_date: t_date
                    },
                    success: function(response) {
                     console.log(response);
                        if (response.msg === 'success') {
                            list = response.result
                            from_Date = response.fdate;
                            to_Date = response.tdate;
                            tot_amt = response.totalAmount;
                            $('.f_date').html(from_Date);
                            $('.t_date').html(to_Date);
                            fill_table(list,tot_amt)
                           
                        }
                        if (response.msg === 'error') {
                            Swal.fire("Please Select The Valid Date Range");
                            $(".fetched_bills").html('');
                            $('.fetched_bills').append(
                                '<p class="text-center text-2xl text-red-900">Invalid Date Range</p>'
                            );

                            $(".prt_body").html('');
                            $('.prt_body').append(
                                '<p class="text-center text-2xl text-red-900">Invalid Date Range</p>'
                            );
                        }
                        if (response.msg === 'nobills') {
                            Swal.fire("There are no bills of this date range");
                            $(".fetched_bills").html('');
                            $('.fetched_bills').append(
                                '<p class="text-center text-2xl text-red-900">No Bills</p>');

                            $(".prt_body").html('');
                            $('.prt_body').append(
                                '<p class="text-center text-2xl text-red-900">Invalid Date Range</p>'
                            );
                        }


                    }
                });
            } else {
                Swal.fire('Invalid range');
            }
        });

        $("#btn_prnt_report").click(function(e) {
            e.preventDefault();

          
            var recipt = $('.print_div').html();
            var printWindow = window.open("");
            printWindow.document.write(recipt);
            printWindow.print();
            printWindow.close();

        });
    </script>
</x-app-layout>
