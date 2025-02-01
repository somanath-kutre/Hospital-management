<x-app-layout>
    <div class="py-4 px-6 font-bold text-2xl">OPD Cards</div>
    <div class=" px-10">
        <form class="float-end" id="patientForm" method="GET" style="display: flex; flex-direction: row; align-items: right;gap:5px; justify-content: right; padding: 2px; margin: 2px; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">    
            <input class="form-control" type="text" id="patientId" placeholder="Enter Patient ID" name="patientId" style="width: 30%; padding: 10px;  border: 1px solid #ccc; border-radius: 5px; font-size: 16px;">
            <x-button class="btn btn-success"  type="submit" style="width: 10%;text-align:center; padding: 10px; font-size: 16px; background-color: #000000; border-color: #000000; color: white; border-radius: 5px; cursor: pointer;" >Submit</x-button>
        </form>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        sl No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Patient ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Patient Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="">
                @php
                    $n = 0;
                @endphp
                @foreach ($patients as $list)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $n = $n + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $list->id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $list->name }}
                        </td>

                        <td class="px-6 py-4">
                            <x-button class="btn_view_card" value="{{ $list->id }}"
                                data-modal-target="view_cards_model" data-modal-toggle="view_cards_model">View
                                Cards</x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-4 px-6">
            {{$patients->links()}}
        </div>
    </div>

    <div>
        <div id="view_cards_model" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            style="background-color: #a5bcff59;">
            <div class="relative w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            All Cards
                        </h3>
                        <button type="button"
                            class="close-pop text-black bg-transparent bg-red-400 hover:bg-red-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="view_cards_model">
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
                                    <th scope="col" class="px-6 py-3">
                                        OPD No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Validity Till
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="cards_table">
                            
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card_body hidden" >
        <x-papers.new_opd_card/>
    </div>

    <script>
        $('#patientForm').on('submit', function(event) {
    event.preventDefault();  // Prevent the default form submission
    
    var patientId = $('#patientId').val();
    var actionUrl = 'patient/' + patientId;  // Construct the dynamic URL
    
    $(this).attr('action', actionUrl);  // Set the form's action attribute to the dynamic URL
    
    this.submit();  // Submit the form with the new action URL
});
    </script>

    <script>
        $(document).ready(function() {
            $('.btn_view_card').click(function(e) {
                e.preventDefault();
                patient_id = $(this).val();
                // console.log(patient_id);
                $.ajax({
                    type: "get",
                    url: "{{ route('rec.get_cards') }}",
                    data: {
                        patn_id: patient_id
                    },
                    success: function(response) {
                        // console.log(response);
                        cards = response.opd_cards;
                        console.log(cards);
                        sl = 1;
                        $('.cards_table').html('');
                        $.each(cards, function(ind, val) {
                            var validityClass = (val.validity !== 'Expired') ? 'text-green-600' : 'text-red-900';
                            $('.cards_table').append(`<tr>
                                    <td scope="col" class="px-6 py-3">
                                       ${sl++}
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                       ${val.id}
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                    ${val.created_on}
                                    </td>
                                    <td scope="col" class="px-6 py-3  val_sts " >
                                    <span class="${validityClass}">${val.validity}</span>
                                    </td>
                                    <td scope="col" class="px-6 py-3">
                                        <x-button class="card_print" value="${val.id}">Print</x-button>
                                    </td>
                                </tr>`);
                        });
                    }
                });
            });

            $(document).on('click','.card_print', function(e){
                e.preventDefault();
                id = $(this).val();
                console.log(id);

                $.each(cards, function (ind, val) { 
                     if(val.id == id){
                        $('.p_name').html(val.name);
                        $('.age').html(val.age);
                        $('.gender').html(val.gender);
                        $('.phone').html(val.phone);
                        $('.c_date').html(val.created_on);
                        $('.v_date').html(val.validity_date);
                        $('.opd_no').html(val.id);
                     }
                });

                var html = $('.card_body').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.print();
                printWindow.close();
            });

        });
    </script>
</x-app-layout>
