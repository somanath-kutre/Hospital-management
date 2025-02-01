<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <div>
        <div class="uppercase text-xl text-green-800 p-5 rounded-md  bg-green-200 dark:bg-gray-700 dark:text-gray-400">
            Case Papers
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
                            <x-button class="bg-green-800 cp_btn" value="{{ $patient->aid }}"
                                data-modal-target="CasePaperModal"
                                data-modal-toggle="CasePaperModal">View</x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <hr>
        </table>
    </div>
    {{-- add prescription modal starts here --}}
    <div>
        <div id="CasePaperModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Case Paper
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="CasePaperModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    {{-- <div class="grid grid-cols-4 gap-4 px-2 py-2">
                        <div class="name">
                            <x-label for="name" value="{{ __('SP O2') }}" />
                            <x-input id="spin" class="block mt-1 w-full " type="text" name=""
                                value="{{ old('') }}" placeholder="Enter SP O2" />
                        </div>
                        <div class="name">
                            <x-label for="name" value="{{ __('PR') }}" />
                            <x-input id="prin" class="block mt-1 w-full " type="text" name=""
                                value="{{ old('') }}" placeholder="Enter PR" />
                        </div>
                        <div>
                            <x-label for="name" value="{{ __('Time') }}" />
                            <x-input id="tmin" class="block mt-1 w-full " type="text" name=""
                                value="{{ old('') }}" placeholder="Enter Time" />
                        </div>
                        <div class="">
                            <div>&nbsp;</div>
                            <x-button class="bg-green-800 mt-1 sub_read" value="">Add</x-button>
                        </div>
                    </div> --}}
                    <!-- Modal body -->

                    <textarea class="content" name="example">
                        <div class="case_paper">
                        <table class="">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div style="font-size:20px">
                                            Registration Number: <span class="p_reg"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:20px">
                                            Date: <span class="date"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div style="font-size:20px">
                                            Name: <span class="p_name"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
    
                                </tr>
                                <td>
                                    <div style="font-size:20px">
                                        Sex: <span class="p_sex"></span>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size:20px">
                                        Age: <span class="p_age"></span>
                                    </div>
                                </td>
    
                                </tr>
                                <tr>
                                    <td>
                                        <div style="font-size:20px">
                                            Address: <span class="p_address"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:20px">
                                            Phone: <span class="p_phone"></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </div>
                    </textarea>
                    <div id="bottom-left-div spo2"></div>
                    <div id="bottom-left-div pr"></div>
                    <div id="bottom-left-div time"></div>


                    <div class="py-4 px-4">
                        <x-button class="bg-blue-800 btn-prnt">
                            Print
                        </x-button>
                    </div>

                    <div class="printable" id="printable">
                        <div class="hidden">
                            <x-letter-head />
                        </div>
                        <br>
                    </div>
                    <div class="head-title hidden">

                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- Case paper modal ends here --}}
    <script src="{{ asset('js/jquery.richtext.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/certificates.js') }}"></script>
    <script>
        $('.content').richText();

        $(document).ready(function() {
            list = <?php echo $data; ?>;

            $(".cp_btn").click(function(e) {
                e.preventDefault();
                id = $(this).val();

                $.each(list, function(ind, val) {
                    if (id == val.aid) {
                        $(".p_reg").html(val.pid);
                        $(".p_name").html(val.patient_name);
                        $(".p_age").html(val.p_age);
                        $(".p_address").html(val.address);
                        $(".p_sex").html(val.gender);
                        $(".date").html(current_date);
                        $(".p_phone").html(val.phone);
                    }
                });

            });

            $(".btn-prnt").click(function(e) {
                e.preventDefault();
                head_case_paper
                var content = $(".case_paper").html();
                var header = $("#printable").html();

                title = $('.head-title').html(`${head_case_paper}`);
                title = $('.head-title').html();

                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.document.write(header);
                printWindow.document.write(title);
                printWindow.document.write(content);
                printWindow.document.write(spo,pr,time);

                printWindow.print();
                printWindow.close();
            });



        });
    </script>

</x-app-layout>
