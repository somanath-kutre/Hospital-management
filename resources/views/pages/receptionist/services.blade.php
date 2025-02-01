<x-app-layout>
    <div>
        <div class="bg-sky-400 headline-bg rounded p-4">
            <div class="font-400 headline">Services</div>
        </div>
        <form action="{{ route('rec.add_ser') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 p-4">
                <div class="service_name">
                    <x-label for="name" value="{{ __('Service name') }}" />
                    <x-input id="service_name" class="block mt-1 w-full " type="text"
                        name="service_name" value="{{ old('service_name') }}" placeholder="Enter Service name" />
                    @error('service_name')
                        <p class="text-red-800"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="Price">
                    <x-label for="name" value="{{ __('Price') }}" />
                    <x-input id="price" class="block mt-1 w-full   amount_input"
                        type="text" name="price" value="{{ old('price') }}" placeholder="Enter Price"
                        inputmode="numeric" />
                    @error('price')
                        <p class="text-red-800"> {{ $message }} </p>
                    @enderror
                </div>
                <div>
                    <x-button class="text-center sub-btn">Submit</x-button>
                </div>
            </div>
        </form>

        <table class="w-full text-sm text-left mt-5 bg-teal-100 rounded text-gray-500 dark:text-gray-400">
            <thead class=" text-black uppercase  dark:bg-gray-700 dark:text-gray-400 ">
                <tr class="">
                    <th scope="col" class="px-6 py-3">
                        SL no
                    </th>
                    <th scope="col" class="px-6">
                        Services
                    </th>
                    <th scope="col" class="px-6">
                        Price
                    </th>
                    <th scope="col" class="px-6">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n = 0;
                @endphp
                @foreach ($services as $post)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $n = $n + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $post->service_name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $post->price }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button id="edt-btn" class="edt-btn" value="{{ $post->id }}">Edit</x-button>
                            <x-button id="dlt-btn" class="dlt-btn bg-red-800" value="{{ $post->id }}">Delete</x-button>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="my-2">
            {{ $services->links() }}
        </div> --}}
    </div>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script>
        function handleNumericInput(inputId, maxLength) {
            $(inputId).on('input', function() {
                const input = $(this).val().replace(/\D/g, '').substring(0, maxLength);
                $(this).val(input);
            });
        }
        handleNumericInput('#price', Infinity); // Usage example for '#amount' input with no maximum length

        // $(".uppercase-transform").keyup(function() {
        //     var inputField = $(this);
        //     inputField.val(inputField.val().toUpperCase()); // Convert the input value to uppercase
        // });

        $(document).ready(function() {
            list = <?php echo $service_list; ?>;
            console.log(list);
            $('.edt-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).val();

                $.each(list, function(ind, val) {
                    if (id == val.id) {
                        // console.log();
                        $("#service_name").val(val.service_name);
                        $("#price").val(val.price);
                        $('html, body').animate({
                            scrollTop: 0
                        }, 600);
                        $(".sub-btn").text('update');
                       
                        $('.sub-btn').addClass('bg-red-800');
                    }
                });

            });

            $('.dlt-btn').click(function (e) { 
                e.preventDefault();
                serv_id = $(this).val();
                console.log("clicked");
                $.ajax({
                    type: "get",
                    url: "{{route('rec.dlt_ser')}}",
                    data: {
                        id:serv_id
                    },
                    // dataType: "dataType",
                    success: function (response) {
                        if(response.msg === 'success'){
                            swal.fire('Deleted Sucessfully')
                            location.reload();
                        }
                        else{
                            swal.fire('Error')
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>
