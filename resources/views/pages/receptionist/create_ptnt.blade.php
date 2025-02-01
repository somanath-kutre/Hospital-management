<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @if (session('success'))
        <div class="my-5">
            <div class="bg-green-800 text-white font-bold px-4 py-2 rounded fadealert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="opd-tab" data-tabs-target="#opd"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">OPD
                    Registration</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="ipd-tab" data-tabs-target="#ipd" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">IPD Registration</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="edtptns-tab" data-tabs-target="#edit_ptn" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Edit Patient</button>
            </li>
        </ul>
    </div>

    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="opd" role="tabpanel"
            aria-labelledby="profile-tab">

            <div class="bg-blue-400 headline-bg rounded p-4">
                <div class="font-400 headline">OPD Registration</div>
            </div>

            <div class="grid grid-cols-3 gap-4 px-4 pt-2 exist_ptn_serch">
                <div>
                    <x-label for="" value="{{ __('Patient Id') }}" />
                    <x-input id="patn_id" name="patn_id" class="block mt-1 w-full" placeholder="Search Patient Id"
                        inputmode="numeric" />
                </div>
                <div>
                    <x-label for="" value="{{ __('OPD Number') }}" />
                    <x-input id="opd_id_no" name="opd_id_no" class="block mt-1 w-full" placeholder="Search OPD Number"
                        inputmode="numeric" />
                </div>
                <div>
                    <x-label for="phone" value="{{ __('Recipt Id') }}" />
                    <x-input id="recipt_id" name="recipt_id" class="block mt-1 w-full" placeholder="Search Patient Id"
                        inputmode="numeric" />
                </div>
            </div>

            <form action="{{ route('rec.reg_usr') }}" id="main_form" method="post">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 p-4">
                    <div class="phone">
                        <x-label for="phone" value="{{ __('Phone Number') }}" />
                        <x-phone id="phone" name="phone" :value="old('phone')" placeholder="Enter phone number" />
                        @error('phone')
                            <p class="text-red-800">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="name">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="p_name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ old('name') }}" placeholder="Enter name" />
                        @error('name')
                            <p class="text-red-800"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="household">
                        <x-label for="name" value="{{ __('Husband / Father Name') }}" />
                        <x-input id="household" class="block mt-1 w-full" type="text" name="household"
                            value="{{ old('household') }}" placeholder="Husband/Father Name" />
                        @error('household')
                            <p class="text-red-800 household"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="age">
                        <x-label for="age" value="{{ __('Age') }}" />
                        <x-input id="age" class="block mt-1 w-full" type="text" name="age"
                            value="{{ old('age') }}" placeholder="Enter age" inputmode="numeric" />
                        @error('name')
                            <p class="text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="gender">
                        <x-label for="name" value="{{ __('Gender') }}" />
                        <x-select id="gender" name="gender" :title="'Select Gender'" :options="['Male' => 'Male', 'Female' => 'Female']"
                            :oldValue="old('gender')" />
                        @error('gender')
                            <p class="text-red-800"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="descr">
                        <x-label for="descr" value="{{ __('Description') }}" />
                        <x-select id="descr1" class="descr descr_input" name="descr" :title="'Select The Description'"
                            :options="['Consultation' => 'Consultation', 'Follow UP' => 'Follow Up']" :oldValue="old('descr')" />
                        @error('descr')
                            <p class="text-red-800"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="amount">
                        <x-label for="amount" value="{{ __(' Amount') }}" />
                        <x-input id="amount" class="block mt-1 w-full amount_input" type="text" name="amount"
                            value="{{ old('amount') }}" placeholder="Enter amount" inputmode="numeric" />
                        @error('amount')
                            <p class="text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="payment_mode">
                        <x-label for="p_method" value="{{ __('Payment Method') }}" />
                        <x-select id="p_method" class="p_method p_method_input" name="p_method" :title="'Select Payment Method'"
                            :options="['cash' => 'CASH', 'upi' => 'UPI']" :oldValue="old('p_method')" />
                        @error('p_method')
                            <p class="text-red-800"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="referal_doc ">
                        <x-label for="ip_ref_doc" value="{{ __('Refered By Dr.') }}" />
                        <x-input id="rfrdoc_input" class="block mt-1 w-full rfrdoc_input" type="text"
                            name="refer_doc" value="{{ old('rfrdoc_input') }}" placeholder="Refered Doctor" />

                        @error('rfrdoc')
                            <p class="text-red-800 err_pmethod"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>



                <div class="p-4 address">
                    <x-label for="age" value="{{ __('Address') }}" />
                    <textarea rows="3" value="{{ old('address') }}" name="address"
                        class="block p-2.5 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Patient's address...">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-800"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="reg_ptn_div">
                    <x-button class="ml-4 bg-red-800 r_patn">
                        {{ __('Register Patient') }}
                    </x-button>
                </div>
            </form>
            <div class="follow_ptn_div">

            </div>
        </div>

        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="ipd" role="tabpanel"
            aria-labelledby="dashboard-tab">

            <div class="bg-green-400 headline-bg rounded p-4">
                <div class="font-400 headline">IPD Registration</div>
            </div>

            {{-- <div class="grid grid-cols-2 gap-4 px-4 pt-2">
               
            </div> --}}

            <form action="{{ route('ipd.reg_ipd') }}" id="ipd_form" method="post">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2  gap-4 p-4">
                    <div class="hidden">
                        <x-input type="text" id="patient_id_ipd" name="patient_id_ipd" class=""
                            value="" />
                        <x-input type="text" id="admission_id_ipd" name="admission_id_ipd" class=""
                            value="" />
                    </div>
                    <div class="opd number">
                        <x-label for="name" value="{{ __('Search OPD Number') }}" />
                        <x-input id="ip_opd_no" class="block mt-1 w-full" type="text" name="ip_opd_no"
                            placeholder="Search OPD Number" />

                    </div>
                    <div class="phone">
                        <x-label for="phone" value="{{ __('Phone Number') }}" />
                        <x-phone id="i_phone" name="i_phone" :value="old('i_phone')" placeholder="Enter phone number" />
                        @error('i_phone')
                            <p class="text-red-800">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="name">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="ip_name" class="block mt-1 w-full" type="text" name="ip_name"
                            value="{{ old('ip_name') }}" placeholder="Enter name" />
                        @error('ip_name')
                            <p class="text-red-800 err_iname"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="operation">
                        <x-label for="name" value="{{ __('Operation Name') }}" />
                        <x-input id="operation_name" class="block mt-1 w-full" type="text" name="operation_name"
                            value="{{ old('operation_name') }}" placeholder="Enter Type Of Operation" />
                        @error('operation_name')
                            <p class="text-red-800 err_i_oper"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="operation_date">
                        <x-label for="name" value="{{ __('Operation Date') }}" />
                        <x-input id="operation_date" class="block mt-1 w-full" type="date" name="operation_date"
                            value="{{ old('operation_date') }}" placeholder="Select Operation Date" />
                        @error('operation_date')
                            <p class="text-red-800 err_ip_oper_date"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="amount">
                        <x-label for="amount" value="{{ __('Advance Amount') }}" />
                        <x-input id="advamount" class="block mt-1 w-full amount_input" type="text"
                            name="advamount" value="{{ old('advamount') }}" placeholder="Enter amount" />
                        @error('advamount')
                            <p class="text-red-800 err_advamt">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="payment_mode">
                        <x-label for="ip_method" value="{{ __('Payment Method') }}" />
                        <x-select id="ip_method" class="ip_method ip_method_input" name="ip_method"
                            :title="'Select Payment Method'" :options="['cash' => 'CASH', 'upi' => 'UPI']" :oldValue="old('ip_method')" />
                        @error('ip_method')
                            <p class="text-red-800 err_pmethod"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="referal_doc ">
                        <x-label for="ip_ref_doc" value="{{ __('Refered By Dr.') }}" />
                        <x-input id="rfrdoc_input" class="block mt-1 w-full rfrdoc_input" type="text"
                            name="rfrdoc_input" value="{{ old('rfrdoc_input') }}" placeholder="Refered Doctor" />

                        @error('rfrdoc_input')
                            <p class="text-red-800 err_pmethod"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="reg_ptn_ipd">
                    <x-button class="ml-4 bg-red-800 r_ipd">
                        {{ __('Register IPD') }}
                    </x-button>
                </div>
            </form>
        </div>

        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="edit_ptn" role="tabpanel"
            aria-labelledby="profile-tab">

            <div class="bg-teal-800 headline-bg rounded p-4">
                <div class="font-400 headline text-white">Edit Patient Details</div>
            </div>

            <div class="grid grid-cols-3 gap-4 px-4 pt-2 exist_ptn_serch">
                <div>
                    <x-label for="" value="{{ __('OPD Number') }}" />
                    <x-input id="edt_opd_id_no" class="block mt-1 w-full" placeholder="Search OPD Number"
                        inputmode="numeric" />
                </div>

            </div>

            <form action="{{ route('rec.edit_usr') }}" id="" method="post">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 p-4">
                    <div class="hidden">
                        <x-input type="text" id="edt_patient_id" name="edt_patient_id" class=""
                            value="" />
                    </div>
                    <div class="phone">
                        <x-label for="phone" value="{{ __('New Phone Number') }}" />
                        <x-phone id="edt_phone" name="edt_phone" :value="old('edt_phone')"
                            placeholder="Enter new phone number" />
                        @error('edt_phone')
                            <p class="text-red-800">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="name">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="edt_p_name" class="block mt-1 w-full" type="text" name="edt_p_name"
                            value="{{ old('edt_p_name') }}" placeholder="Enter name" />
                        @error('edt_p_name')
                            <p class="text-red-800 edt_p_name_err"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="household">
                        <x-label for="name" value="{{ __('Husband / Father Name') }}" />
                        <x-input id="edt_household" class="block mt-1 w-full" type="text" name="edt_household"
                            value="{{ old('edt_household') }}" placeholder="Husband/Father Name" />
                        @error('edt_household')
                            <p class="text-red-800 edt_household_err"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="age">
                        <x-label for="age" value="{{ __('Age') }}" />
                        <x-input id="edt_age" class="block mt-1 w-full" type="text" name="edt_age"
                            value="{{ old('edt_age') }}" placeholder="Enter age" inputmode="numeric" />
                        @error('edt_age')
                            <p class="text-red-400 edt_age_err">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="gender">
                        <x-label for="name" value="{{ __('Gender') }}" />
                        <x-select id="edt_gender" name="edt_gender" class="edt_gender" :title="'Select Gender'"
                            :options="['Male' => 'Male', 'Female' => 'Female']" :oldValue="old('edt_gender')" />
                        @error('edt_gender')
                            <p class="text-red-800 edt_gender_err"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>

                <div class="p-4 address">
                    <x-label for="age" value="{{ __('Address') }}" />
                    <textarea rows="3" name="edt_address" id="edt_address"
                        class="edt_address block p-2.5 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Patient's address...">{{ old('edt_address') }}</textarea>
                    @error('edt_address')
                        <p class="text-red-800 edt_address_err"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="reg_ptn_div">
                    <x-button class="ml-4 bg-red-800 ">
                        {{ __('Update Patient') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Add event listener for the select input
        document.getElementById('descr1').addEventListener('change', function () {
            const selectedValue = this.value;
            const amountInput = document.getElementById('amount');
            
            // Set the amount based on the selected option
            if (selectedValue === 'Consultation') {
                amountInput.value = 500; // Amount for Consultation
            } else if (selectedValue === 'Follow UP') {
                amountInput.value = ""; // Amount for Follow Up
            } else {
                amountInput.value = ''; // Reset the amount field if no valid option is selected
            }
            
        });
    </script>

    <script>
        function handleNumericInput(inputId, maxLength) {
            $(inputId).on('input', function() {
                const input = $(this).val().replace(/\D/g, '').substring(0, maxLength);
                $(this).val(input);
            });
        }
        handleNumericInput('#i_phone', 10);
        handleNumericInput('#edt_phone', 10);
        handleNumericInput('#phone', 10); // Usage example for '#test' input with a maximum length of 10 characters
        handleNumericInput('#age', 2); // Usage example for '#age' input with a maximum length of 2 characters
        handleNumericInput('#amount', Infinity); // Usage example for '#amount' input with no maximum length
    </script>

    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        $(document).ready(function() {
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
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.error == 'Not_found') {
                                console.log(response.error);
                                if (phone.length == 10) {
                                    swal.fire('New Patient')
                                    $("#p_name").val("");
                                    $("#opd_id_no").val('');
                                    $("#patn_id").val('');
                                    $("#descr1").val('Consultation');
                                    var form = $("#main_form");
                                    form.attr('action', "{{ route('rec.reg_usr') }}")
                                }
                                if (phone.length != 10) {
                                    Swal.fire('Invalid Phone number')
                                }
                                $(".reg_ptn_div").html(`<x-button class="ml-4 bg-red-800 r_patn">
                            {{ __('Register Patient') }}
                            </x-button>`);
                                $(".follow_ptn_div").html("");
                                $(".age").show();
                                $(".gender").show();
                                $(".address").show();
                                $(".household").show();
                                // $("#phone").val('');
                            } else if (response.msg == 'running patient') {
                                console.log("existing Patient");
                                list = response.name;
                                p_name = list['name'];
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.reg_usr') }}")
                                // Swal.fire(`${p_name}  Already Exists`, 'Go to all patients')
                                Swal.fire({
                                    icon: 'info',
                                    title: `${p_name}`,
                                    text: 'Already Exists!!',
                                    // footer: '<a href="{{ route('rec.ipd_papers') }}">Why do I have this issue?</a>'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "{{ route('rec.ipd_papers') }}";
                                    } else {
                                        phone = "";
                                    }
                                })
                            } else if (response.msg == 'Follow-up admission allowed') {
                                list = response.name;
                                opd_record = response.opd_details;
                                $("#amount").focus();
                                a_id = response.a_id;
                                console.log(a_id);
                                a_date = response.patient_date;
                                console.log(list, a_date);
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.follow_up') }}")
                                p_name = list['name'];
                                Swal.fire('Follow-up Patient', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 follow_patn" id="follow_patn">
                            {{ __('Follow-up') }}
                            </x-button>`);
                                $("#p_name").val(p_name);
                                $("#opd_id_no").val(opd_record['id']);
                                $("#patn_id").val(opd_record['patient_id']);
                                $("#descr1").val('Follow UP');
                                // $("#a_id").val();
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $(".household").hide();
                                $('.referal_doc ').hide();
                            } else if (response.msg == 'New admission required') {
                                $("#amount").focus();
                                a_id = response.a_id;
                                list = response.name;
                                opd_record = response.opd_details;
                                $("#admission_id_ipd").val(a_id['id']);
                                // console.log(a_id, response);
                                p_name = list['name'];
                                // console.log(p_name);
                                Swal.fire('New Admission Required', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 rnwal_patn" value="${a_id}">
                            {{ __('Renewal Appointment') }}
                            </x-button>`);
                                $("#p_name").val(p_name);
                                $("#opd_id_no").val(opd_record['id']);
                                $("#patn_id").val(opd_record['patient_id']);
                                $("#descr1").val('Consultation');
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $('.household').hide();
                                $('.referal_doc').hide();
                            }
                        }
                    });
                }
            });

            $("#opd_id_no").change(function(e) {
                e.preventDefault();
                var opd_id_no = $(this).val();
                console.log(opd_id_no);
                if (opd_id_no.length !== 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.get_ext_pts') }}",
                        data: {
                            opd_id_no: opd_id_no
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.error == 'Not_found') {
                                console.log(response.error);
                                Swal.fire('Patient Doesnt Exist')
                                $(".reg_ptn_div").html(`<x-button class="ml-4 bg-red-800 r_patn">
                            {{ __('Register Patient') }}
                            </x-button>`);
                                $("#descr1").val('Consultation');
                                $(".follow_ptn_div").html("");
                                $(".age").show();
                                $(".gender").show();
                                $(".address").show();
                                $(".household").show();
                                $("#phone").val('');
                                $("#patn_id").val('');
                                $("#p_name").val('');
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.reg_usr') }}")
                            } else if (response.msg == 'running patient') {
                                console.log("existing Patient");
                                list = response.name;
                                p_name = list['name'];
                                // Swal.fire(`${p_name}  Already Exists`, 'Go to all patients')
                                Swal.fire({
                                    icon: 'info',
                                    title: `${p_name}`,
                                    text: 'Already Exists!!',
                                    // footer: '<a href="{{ route('rec.ipd_papers') }}">Why do I have this issue?</a>'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "{{ route('rec.ipd_papers') }}";
                                    } else {
                                        phone = "";
                                    }
                                })
                            } else if (response.msg == 'Follow-up admission allowed') {
                                $('#amount').focus()
                                list = response.name;
                                a_id = response.a_id;
                                opd_record = response.opd_details;
                                a_date = response.patient_date;
                                console.log(list, a_date);
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.follow_up') }}")
                                p_name = list['name'];
                                Swal.fire('Follow-up Patient', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 follow_patn" id="follow_patn">
                            {{ __('Follow-up') }}
                            </x-button>`);

                                $("#p_name").val(p_name);
                                $("#patn_id").val(opd_record['patient_id']);
                                $("#descr1").val('Follow UP');
                                $("#phone").val(list['phone']);
                                // $("#a_id").val();
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $(".household").hide();
                                $('.referal_doc ').hide();
                            } else if (response.msg == 'New admission required') {
                                $('#amount').focus()
                                a_id = response.a_id;
                                list = response.name;
                                opd_record = response.opd_details;
                                $("#admission_id_ipd").val(a_id['id']);
                                // console.log(a_id, response);
                                p_name = list['name'];
                                // console.log(p_name);
                                Swal.fire('New Admission Required', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 rnwal_patn" value="${a_id}">
                            {{ __('Renewal Appointment') }}
                            </x-button>`);
                                $("#p_name").val(p_name);
                                $("#phone").val(list['phone']);
                                $("#patn_id").val(opd_record['patient_id']);
                                $("#descr1").val('Consultation');
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $('.household').hide();
                                $('.referal_doc').hide();
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
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.error == 'Not_found') {
                                console.log(response.error);
                                Swal.fire('Patient Doesnt Exist')
                                $("#descr1").val('Consultation');
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.reg_usr') }}")
                                $(".reg_ptn_div").html(`<x-button class="ml-4 bg-red-800 r_patn">
                            {{ __('Register Patient') }}
                            </x-button>`);
                                $(".follow_ptn_div").html("");
                                $(".age").show();
                                $(".gender").show();
                                $(".address").show();
                                $(".household").show();
                                $("#phone").val('');
                                $("#opd_id_no").val('');
                            } else if (response.msg == 'running patient') {
                                console.log("existing Patient");
                                list = response.name;
                                p_name = list['name'];
                                // Swal.fire(`${p_name}  Already Exists`, 'Go to all patients')
                                Swal.fire({
                                    icon: 'info',
                                    title: `${p_name}`,
                                    text: 'Already Exists!!',
                                    // footer: '<a href="{{ route('rec.ipd_papers') }}">Why do I have this issue?</a>'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "{{ route('rec.ipd_papers') }}";
                                    } else {
                                        phone = "";
                                    }
                                })
                            } else if (response.msg == 'Follow-up admission allowed') {
                                $('#amount').focus()
                                list = response.name;
                                a_id = response.a_id;
                                opd_record = response.opd_details;
                                a_date = response.patient_date;
                                console.log(list, a_date);
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.follow_up') }}")
                                p_name = list['name'];
                                Swal.fire('Follow-up Patient', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 follow_patn" id="follow_patn">
                            {{ __('Follow-up') }}
                            </x-button>`);

                                $("#p_name").val(p_name);
                                $("#opd_id_no").val(opd_record['id']);
                                $("#descr1").val('Follow UP');
                                $("#phone").val(list['phone']);
                                // $("#a_id").val();
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $(".household").hide();
                                $('.referal_doc ').hide();
                            } else if (response.msg == 'New admission required') {
                                $('#amount').focus()
                                a_id = response.a_id;
                                list = response.name;
                                opd_record = response.opd_details;
                                $("#admission_id_ipd").val(a_id['id']);
                                // console.log(a_id, response);
                                p_name = list['name'];
                                // console.log(p_name);
                                $("#opd_id_no").val(opd_record['id']);
                                Swal.fire('New Admission Required', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 rnwal_patn" value="${a_id}">
                            {{ __('Renewal Appointment') }}
                            </x-button>`);
                                $("#p_name").val(p_name);
                                $("#descr1").val('Consultation');
                                $("#phone").val(list['phone']);
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $('.household').hide();
                                $('.referal_doc').hide();
                            }
                        }
                    });
                }
            });


            $("#recipt_id").change(function(e) {
                e.preventDefault();
                var recipt_id = $(this).val();
                if (recipt_id.length !== 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.get_ext_pts') }}",
                        data: {
                            recipt_id: recipt_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.error == 'Not_found') {
                                console.log(response.error);
                                Swal.fire('Patient Doesnt Exist')
                                $("#descr1").val('Consultation');
                                $("#p_name").val('');
                                $('#phone').val('');
                                $("#opd_id_no").val('');
                                $('#patn_id').val('');
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.reg_usr') }}")
                                $(".reg_ptn_div").html(`<x-button class="ml-4 bg-red-800 r_patn">
                            {{ __('Register Patient') }}
                            </x-button>`);
                                $(".follow_ptn_div").html("");
                                $(".age").show();
                                $(".gender").show();
                                $(".address").show();
                                $(".household").show();
                            } else if (response.msg == 'running patient') {
                                console.log("existing Patient");
                                list = response.name;
                                p_name = list['name'];
                                // Swal.fire(`${p_name}  Already Exists`, 'Go to all patients')
                                Swal.fire({
                                    icon: 'info',
                                    title: `${p_name}`,
                                    text: 'Already Exists!!',
                                    // footer: '<a href="{{ route('rec.ipd_papers') }}">Why do I have this issue?</a>'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "{{ route('rec.ipd_papers') }}";
                                    } else {
                                        phone = "";
                                    }
                                })
                            } else if (response.msg == 'Follow-up admission allowed') {
                                $('#amount').focus()
                                list = response.name;
                                a_id = response.a_id;
                                a_date = response.patient_date;
                                opd_record = response.opd_details;
                                console.log(list);
                                var form = $("#main_form");
                                form.attr('action', "{{ route('rec.follow_up') }}")
                                p_name = list['name'];
                                Swal.fire('Follow-up Patient', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 follow_patn" id="follow_patn">
                            {{ __('Follow-up') }}
                            </x-button>`);
                                $("#p_name").val(p_name);
                                $('#phone').val(list['phone']);
                                $("#opd_id_no").val(opd_record['id']);
                                $('#patn_id').val(opd_record['patient_id']);
                                $("#descr1").val('Follow UP');
                                // $("#a_id").val();
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $(".household").hide();
                                $('.referal_doc ').hide();
                            } else if (response.msg == 'New admission required') {
                                $('#amount').focus()
                                a_id = response.a_id;
                                list = response.name;
                                opd_record = response.opd_details;
                                $("#admission_id_ipd").val(a_id['id']);
                                // console.log(a_id, response);
                                p_name = list['name'];
                                // console.log(p_name);
                                Swal.fire('New Admission Required', p_name)
                                $(".reg_ptn_div").html("");
                                $(".follow_ptn_div").html(`<x-button class="ml-4 bg-blue-800 rnwal_patn" value="${a_id}">
                            {{ __('Renewal Appointment') }}
                            </x-button>`);
                                $("#p_name").val(p_name);
                                $('#phone').val(list['phone']);
                                $("#opd_id_no").val(opd_record['id']);
                                $('#patn_id').val(opd_record['patient_id']);
                                $("#descr1").val('Consultation');
                                $(".age").hide();
                                $(".gender").hide();
                                $(".address").hide();
                                $('.household').hide();
                                $('.referal_doc').hide();
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.follow_patn', function(e) {
                e.preventDefault();
                console.log(a_id);
                descr = $(".descr_input").val();
                amount = $(".amount_input").val();
                p_mode = $(".p_method_input").val();
                name = $("#p_name").val();
                refer_doc = $('.rfrdoc_input').val();
                console.log(descr, amount, p_mode);

                if (descr == 'Select The Description') {
                    swal.fire('Please Select Description');
                } else if (amount != '' && p_mode == 'Select Payment Method') {
                    swal.fire('Please Select Payment Mode');
                } else if (amount == null && p_mode == 'Select Payment Method') {
                    p_mode = 'No Payment'
                    amount = '0'
                } else {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.follow_up') }}",
                        data: {
                            id: a_id,
                            name: name,
                            amount: amount,
                            p_mode: p_mode,
                            descr: descr,
                            refer_doc: refer_doc
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.msg == 'success') {
                                window.location.href = "{{ route('rec.ipd_papers') }}";
                            }
                        }
                    });
                }



            });

            $(document).on('click', '.rnwal_patn', function(e) {
                e.preventDefault();
                var a_id = $("#admission_id_ipd").val();
                console.log(a_id);
                descr = $(".descr_input").val();
                amount = $(".amount_input").val();
                p_mode = $(".p_method_input").val();
                name = $("#p_name").val();
                console.log(descr, amount, p_mode);

                if (descr == 'Select The Description') {
                    swal.fire('Please Select Description');
                } else if (amount != '' && p_mode == 'Select Payment Method') {
                    swal.fire('Please Select Payment Mode');
                } else if (amount == null && p_mode == 'Select Payment Method') {
                    p_mode = 'No Payment'
                    amount = '0'
                } else {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('rec.renewal') }}",
                        data: {
                            id: a_id,
                            name: name,
                            amount: amount,
                            p_mode: p_mode,
                            descr: descr
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.msg == 'success') {
                                window.location.href = "{{ route('rec.ipd_papers') }}";
                            }
                        }
                    });
                }


            });
        });
    </script>

    <script>
        //IPD Registration scripts

        $(document).ready(function() {
            name = $(".err_iname").text().trim();
            p_method = $(".err_pmethod").text().trim();
            adv_amt = $(".err_advamt").text().trim();
            op_date = $(".err_ip_oper_date").text().trim();
            op_name = $(".err_i_oper").text().trim();
            if (p_method === "Please select the payment mode" || adv_amt === 'Please Enter The Advance Amount' ||
                name === 'Please enter the name' || op_date === 'Please select the operation date' || op_name ===
                'Please enter the operation name') {
                $("#ipd-tab").trigger('click');

                // Modify the attributes of the "OPD Registration" button
                $("#ipd-tab")
                    .attr('aria-selected',
                        'true') // Set 'aria-selected' to 'true'
                    .addClass(
                        'selected'); // Add a CSS class, e.g., 'selected'

            }

        });

        $("#i_phone").change(function(e) {
            e.preventDefault();
            var phone = $(this).val();
            console.log(phone);
            $.ajax({
                type: "GET",
                url: "{{ route('ipd.get_ext_pts') }}",
                data: {
                    phone: phone
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.msg == 'Not_found') {
                        if (phone.length != 10) {
                            Swal.fire('Invalid Phone number')
                            $("#ip_opd_no").val('');
                            $("#ip_name").val('');
                            $("#i_phone").val('');
                        } else {
                            Swal.fire(`New Patient`).then((result) => {
                                if (result.isConfirmed) {
                                    $("#opd-tab").trigger('click');
                                    $("#ip_opd_no").val('');
                                    $("#ip_name").val('');
                                    $("#i_phone").val('');

                                    // Modify the attributes of the "OPD Registration" button
                                    $("#opd-tab")
                                        .attr('aria-selected',
                                            'true') // Set 'aria-selected' to 'true'
                                        .addClass(
                                            'selected'); // Add a CSS class, e.g., 'selected'
                                }
                            });
                        }
                    }
                    if (response.msg == 'running patient') {
                        $("#ip_opd_no").val('');
                        $("#ip_name").val('');
                        $("#i_phone").val('');
                        Swal.fire({
                            icon: 'info',
                            text: "Running Patient",
                            title: response.name['name']
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (result.isConfirmed) {
                                    window.location = "{{ route('rec.ipd_papers') }}";
                                }
                            }
                        });
                    }
                    if (response.msg == 'All_OK') {
                        $("#patient_id_ipd").val(response.name['id']);
                        Swal.fire(`${response.name['name']} is Available to IPD`);
                        $("#ip_name").val(response.name['name']);
                        $("#ip_opd_no").val(response.opd_id);
                    }
                    if (response.msg == 'NOT_OK') {
                        $("#ip_opd_no").val('');
                        $("#ip_name").val('');
                        $("#i_phone").val('');
                        Swal.fire({
                            title: 'Validity Expired',
                            text: 'OPD Registration Is Required'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#opd-tab").trigger('click');

                                // Modify the attributes of the "OPD Registration" button
                                $("#opd-tab")
                                    .attr('aria-selected',
                                        'true') // Set 'aria-selected' to 'true'
                                    .addClass('selected'); // Add a CSS class, e.g., 'selected'
                            }
                        });
                    }
                }
            });
        });

        $("#ip_opd_no").change(function(e) {
            e.preventDefault();
            var ip_opd_no = $(this).val();
            console.log(ip_opd_no);
            $.ajax({
                type: "GET",
                url: "{{ route('ipd.get_ext_pts') }}",
                data: {
                    ip_opd_no: ip_opd_no
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.msg == 'Not_found') {
                        if (response.msg == 'Not_found') {
                            Swal.fire('Patient Not Found')
                            $("#ip_opd_no").val('');
                            $("#ip_name").val('');
                            $("#i_phone").val('');
                        } else {
                            Swal.fire(`New Patient`).then((result) => {
                                if (result.isConfirmed) {
                                    $("#ip_opd_no").val('');
                                    $("#ip_name").val('');
                                    $("#i_phone").val('');

                                    $("#opd-tab").trigger('click');
                                    // Modify the attributes of the "OPD Registration" button
                                    $("#opd-tab")
                                        .attr('aria-selected',
                                            'true') // Set 'aria-selected' to 'true'
                                        .addClass(
                                            'selected'); // Add a CSS class, e.g., 'selected'
                                }
                            });
                        }
                    }
                    if (response.msg == 'running patient') {
                        $("#patient_id_ipd").val(response.name['id']);
                        $("#ip_opd_no").val('');
                        $("#ip_name").val('');
                        $("#i_phone").val('');
                        Swal.fire({
                            icon: 'info',
                            text: "Running Patient",
                            title: response.name['name']
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (result.isConfirmed) {
                                    window.location = "{{ route('rec.ipd_papers') }}";
                                }
                            }
                        });
                    }
                    if (response.msg == 'All_OK') {
                        $('#operation_name').focus();
                        $("#patient_id_ipd").val(response.name['id']);
                        Swal.fire(`${response.name['name']} is Available to IPD`);
                        $("#ip_name").val(response.name['name']);
                        $("#i_phone").val(response.name['phone']);
                        $("#ip_opd_no").val(response.opd_id);

                    }
                    if (response.msg == 'NOT_OK') {
                        $("#ip_opd_no").val('');
                        $("#ip_name").val('');
                        $("#i_phone").val('');
                        Swal.fire({
                            title: 'Validity Expired',
                            text: 'OPD Registration Is Required'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#opd-tab").trigger('click');

                                // Modify the attributes of the "OPD Registration" button
                                $("#opd-tab")
                                    .attr('aria-selected',
                                        'true') // Set 'aria-selected' to 'true'
                                    .addClass('selected'); // Add a CSS class, e.g., 'selected'
                            }
                        });
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            edt_name = $(".edt_p_name_err").text().trim();
            edt_phone = $(".edt_phone_err").text().trim();
            edt_household = $(".edt_household_err").text().trim();
            edt_age = $(".edt_age_err").text().trim();
            edt_gender = $(".edt_gender_err").text().trim();
            edt_address = $(".edt_address_err").text().trim();

            if (edt_phone == 'The phone number has already been taken.' || edt_phone ==
                'The phone number must be a valid Indian mobile number.' || edt_name === 'Name field is required' ||
                edt_household != '' ||
                edt_age === 'please enter age' || edt_gender === 'Please select the gender' || edt_address ===
                'Address is required') {
                $("#edtptns-tab").trigger('click');
            }

            $("#edt_opd_id_no").change(function(e) {
                e.preventDefault();
                var opd_id_no = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_ext_pts') }}",
                    data: {
                        opd_id_no: opd_id_no
                    },
                    success: function(response) {
                        if (response.error !== 'Not_found') {
                            $("#edt_patient_id").val(response.name['id']);
                            $('#edt_phone').val(response.name['phone']);
                            $('#edt_p_name').val(response.name['name']);
                            $('#edt_household').val(response.name['household']);
                            $('#edt_age').val(response.name['age']);
                            $('.edt_gender').val(`${response.name['gender']}`);
                            $('#edt_address').val(response.name['address']);

                            // Swal.fire('Success');
                            console.log(response);
                        } else {
                            Swal.fire('Patient does not exist')
                            $('#edt_phone').val('');
                            $('#edt_p_name').val('');
                            $('#edt_household').val('');
                            $('#edt_age').val('');
                            $('#edt_address').val('');
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>
