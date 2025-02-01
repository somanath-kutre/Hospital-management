<x-app-layout>
    @foreach ($patient_data as $patients)
        @php
            $name = $patients->name;
            $address = $patients->address;
            $age = $patients->age;
            $phone = $patients->phone;
            $id = $patients->id;
        @endphp
    @endforeach
    <div class="dark:bg-gray-600">
        <h2 class="text-xl font-semibold dark:text-white">Patient Details</h2>
    </div>
    <div class="p-4 border-b">

        <div class=" grid grid-cols-3 text-gray-900 dark:bg-gray-700">
            <div class=" m-2">Name : <span class="font-semibold">{{ $name }}</span></div>
            <div class="m-2">Age: <span class="font-semibold">{{ $age }}</span></div>
        </div>
        <div class="grid grid-cols-3 text-gray-900 dark:bg-gray-700">
            <div class=" m-2">Phone : <span class="font-semibold">{{ $phone }}</span></div>
            <div class="m-2">Address: <span class="font-semibold">{{ $address }}</span></div>
        </div>
    </div>
    <div>
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mt-3">
            Billing Deatils
        </h3>
    </div>
    <div class="relative w-full max-w-3xl max-h-full ">

        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 space-y-6" id="">
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
                            <tbody class="">
                                @php $total_sum = 0;@endphp
                                @foreach ($bill as $bills)
                                    @php
                                        $total = $bills->amount * $bills->qty;
                                        $total_sum = $total_sum + $total;
                                    @endphp
                                    <tr>
                                        <td class="py-2 px-4">{{ $bills->description }}</td>
                                        <td class="py-2 px-4">{{ $bills->qty }}</td>
                                        <td class="py-2 px-4">{{ $bills->amount }}</td>
                                        <td class="py-2 px-4">{{ $total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-200">
                                    <td colspan="3" class="py-2  text-right font-semibold ">Total :
                                    </td>
                                    <td class="py-2 float-left pl-3 text-right font-semibold ">
                                        {{ $total_sum }}</td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td colspan="3" class="py-2  text-right font-semibold ">Discount :
                                    </td>
                                    <td class="py-2 float-left pl-3 text-right font-semibold ">
                                        {{ $dis_amt }}</td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td colspan="3" class="py-2  text-right font-semibold ">Paid :
                                    </td>
                                    <td class="py-2 float-left pl-3 text-right font-semibold ">
                                        {{ $paid }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="bg-gray-200 p-4 mt-2 rounded">
                        <div class=" my-3 ">
                            <form id="final_bill_form" action="{{ route('rec.sub_opd_bill') }}">
                                @csrf
                                <div class="hidden">
                                    <x-label for="bill" value="{{ __('Id') }}" />
                                    <x-input id="admission_id" class="block mt-1 w-full a_id" type="text"
                                        name="admission_id" value="{{ $id }}" placeholder="Admission Id"
                                        required />
                                </div>

                                <div>
                                    <div class="flex items-center mb-4">
                                        <input id="dis-check" type="checkbox" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-checkbox"
                                            class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">Discount</label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5">
                                    <div class="mt-1">
                                        <x-label value="Bill Due Amount : {{ $total_sum - $paid - $dis_amt }}" />
                                        {{-- <x-input type="text" name="bill_pay" value="{{ $total_sum - $paid }}"
                                            id="bill_pay"  /> --}}
                                        <x-input type="text" name="bill_pay" class="w-full bill_pay"
                                            value="{{ old('bill_pay') }}" id="bill_pay" />
                                        @error('bill_pay')
                                            <p class="text-red-800"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="hidden d_amt_div">
                                        <x-label for="p_method" value="{{ __('Discount Amount') }}" />
                                        <x-input type="number" name="d_amount" class="w-full"
                                            value="{{ old('d_amount') }}" id="d_amount"
                                            placeholder="Enter Discount Amount" />
                                        @error('d_amount')
                                            <p class="text-red-800"> {{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <x-label for="p_method" value="{{ __('Description') }}" />
                                        <x-input type="text" name="descr" class="w-full"
                                            value="{{ old('descr') }}" id="descr"
                                            placeholder="Enter Description" />
                                        @error('descr')
                                            <p class="text-red-800"> {{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <x-label for="p_method" value="{{ __('Payment Method') }}" />
                                        <x-select id="p_method" name="p_method" :title="'Select Payment Method'" :options="['cash' => 'CASH', 'upi' => 'UPI']"
                                            :oldValue="old('p_method')" />
                                        @error('p_method')
                                            <p class="text-red-800"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <x-label class="mt-5" />
                                    <x-button class="bg-green-800 btn_pay" disabled>Pay Outstanding</x-button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#bill_pay").focus();
            due_amt = '<?php echo $total_sum - $paid; ?>';
            var ini_checked = $('#dis-check').is(':checked');
            if (!ini_checked) {
                $(".btn_pay").prop("disabled", false);
            }

            $(".bill_pay").change(function(e) {
                e.preventDefault();
                var checked = $('#dis-check').is(':checked');
                b_amount = $(this).val();
                if (!checked) {
                    console.log(b_amount);
                    if (b_amount != due_amt) {
                        $(".btn_pay").prop("disabled", true);
                        Swal.fire(`Due amount is ${due_amt}`)
                    }
                    if (b_amount === due_amt) 
                    {
                        $(".btn_pay").prop("disabled", false);
                    }
                }
            });

            $("#dis-check").change(function(e) {
                e.preventDefault();
                var checked = $('#dis-check').is(':checked');
                $(".d_amt_div").toggleClass('hidden', !checked);
                $(".d_amt_div").toggleClass('block', checked);
                if (!checked) {
                    $(".btn_pay").prop("disabled", false);
                }
            });

            $(".btn_pay").click(function(e) {
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
                        $('#final_bill_form').submit();

                    }
                });
            });



            $("#d_amount").change(function(e) {
                e.preventDefault();
                var discount_amount = $(this).val();
                var installment = $('#bill_pay').val();
                console.log(discount_amount, installment);
                tot_amount = parseInt(installment) + parseInt(discount_amount);
                if (discount_amount === '0' || discount_amount === '') {
                    swal.fire("Discount Cant Be Null");
                    $(".btn_pay").prop("disabled", true);
                } else if (tot_amount != due_amt) {
                    swal.fire(`Invalid amount details`);
                    $(".btn_pay").prop("disabled", true);
                } else {
                    $(".btn_pay").prop("disabled", false);
                }
            });
        });
    </script>
</x-app-layout>
