<x-app-layout>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <div class="py-4 px-6 font-bold text-2xl">Prescriptions</div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Patient Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $list)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $list->patient_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $list->type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $list->admission_date }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button class="btn-medicate" value="{{ $list->id }}" data-modal-target="AddbillModal"
                                data-modal-toggle="AddbillModal">Prescribe</x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>

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
                        <div class="grid grid-cols-3 gap-2">
                            <div class="name">
                                <x-label for="name" value="{{ __('Medication') }}" />
                                <x-input id="medicine" class="block mt-1 w-full medicine" type="text"
                                    name="medicine" value="{{ old('medicine') }}" placeholder="Enter Medication" />
                            </div>
                            <div class="name">
                                <x-label for="name" value="{{ __('Strenth') }}" />
                                <x-input id="strenth" class="block mt-1 w-full strenth" type="number" name="strenth"
                                    value="{{ old('strenth') }}" placeholder="Enter strenth" />
                            </div>

                            <div>
                                <x-label for="name" value="{{ __('Dosage') }}" />
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="mt-3">
                                        <input id="morn-check" type="checkbox"s value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            checked>
                                        <label for="default-checkbox"
                                            class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">Mor</label>
                                    </div>
                                    <div class="mt-3">
                                        <input id="aft-check" type="checkbox" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            checked>
                                        <label for="default-checkbox"
                                            class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">aft</label>
                                    </div>
                                    <div class="mt-3">
                                        <input id="nght-check" type="checkbox" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            checked>
                                        <label for="default-checkbox"
                                            class="ms-2 text-md font-medium text-gray-900 dark:text-gray-300">Ngt</label>
                                    </div>
                                </div>

                            </div>
                            <div class="px-2">
                                <x-label for="name" value="{{ __('') }}" />
                                <x-button class="bg-green-800 add_pre">
                                    add
                                </x-button>


                            </div>
                        </div>
                        <div class="">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Medication Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dosage
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Streanth
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="meds_list">

                                </tbody>
                            </table>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('rec.prt_meds') }}" class="pt-3">
                                @csrf
                                <div class="prt_div">

                                </div>
                                
                                <div class="btn_div">
                                    <x-button class="bg-red-800 btn_pay_bill" id="btn_pay_bill" value="">
                                        Print
                                    </x-button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- add prescription modal ends here --}}
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
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

            function gen_table(meds) {
                $('.meds_list').html("");
                $.each(meds, function(ind, val) {
                    admission_id = val.admission_id
                    $('.meds_list').append(`<tr>
                                        <td class="px-6 py-3">${val.medicine}</td>
                                        <td class="px-6 py-3">${val.dosage}</td>
                                        <td class="px-6 py-3">${val.strenth}</td>
                                        <td><x-button class="btn-rm-meds" value="${val.id}">remove</x-button></td>
                                    </tr>`);
                });
                $('.prt_div').html(`<input type="hidden" name="btn_pay_adv" class="aid" value="${admission_id}">`);
            }

            $('.btn-medicate').click(function(e) {
                e.preventDefault();
                var aid = $(this).val();
                $('.a_id').val(aid);

                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_meds') }}",
                    data: {
                        admission_id: aid,
                    },
                    success: function(response) {
                        meds = response.all_meds;
                        console.log(meds);
                        gen_table(meds);
                        $('#medicine').focus();
                        if(meds == '')
                        {
                            $(".btn_div").html('');
                        }
                    }
                });
            });

            $('.add_pre').click(function(e) {
                e.preventDefault();
                var aid = $('.a_id').val();
                var mor_chk = $('#morn-check').is(':checked');
                var aft_chk = $('#aft-check').is(':checked');
                var ngt_chk = $('#nght-check').is(':checked');
                var name = $('#medicine').val();
                var str = $('#strenth').val();

                mor_chk = mor_chk ? '1' : '0';
                aft_chk = aft_chk ? '1' : '0';
                ngt_chk = ngt_chk ? '1' : '0';

                var dosage = `${mor_chk}-${aft_chk}-${ngt_chk}`;

                if (name != '' && str != '' && dosage != '0-0-0') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('rec.add_prescription') }}",
                        data: {
                            admission_id: aid,
                            medicine: name,
                            dosage: dosage,
                            strenth: str
                        },
                        success: function(response) {
                            meds = response.old_meds
                            gen_table(meds);
                            $('.btn_div').html(`<x-button class="bg-red-800" id="" value="">Print</x-button>`);
                            $('#medicine').val('');
                            $('#strenth').val('');
                            $('#medicine').focus();
                        }
                    });
                } else {
                    swal.fire('invalid prescription');
                }
            });

            $(document).on('click', '.btn-rm-meds', function(e) {
                e.preventDefault();
                var id = $(this).val();
                aid = $(".aid").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ route('rec.dlt_med') }}",
                    data: {
                        id: id,
                        admission_id: aid
                    },
                    success: function(response) {
                        meds = response.meds
                        gen_table(meds);
                    }
                });
            });
        });
    </script>
</x-app-layout>
