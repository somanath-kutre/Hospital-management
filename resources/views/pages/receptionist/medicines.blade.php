<x-app-layout>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  

    <div class="bg-blue-400 headline-bg rounded p-4">
        <div class="font-400 headline">Medicines</div>
    </div>
    <form action="{{ route('rec.add_medicine') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 p-4">
            <div class="brand_name">
                <x-label for="name" value="{{ __('Medicine name') }}" />
                <x-input id="b_name" class="block mt-1 w-full uppercase uppercase-transform" type="text"
                    name="b_name" value="{{ old('b_name') }}" placeholder="Enter medicine name" />
                @error('b_name')
                    <p class="text-red-800"> {{ $message }} </p>
                @enderror
            </div>

            <div class="molecule name">
                <x-label for="name" value="{{ __('Molecule Name') }}" />
                <x-input id="molecule" class="block mt-1 w-full uppercase uppercase-transform" type="text"
                    name="molecule" value="{{ old('molecule') }}" placeholder="Enter Molecule" />
                @error('molecule')
                    <p class="text-red-800"> {{ $message }} </p>
                @enderror

            </div>
            <div class="category name">
                <x-label for="name" value="{{ __('Molecule Category') }}" />
                <x-input id="category" class="block mt-1 w-full uppercase uppercase-transform" type="text"
                    name="category" value="{{ old('category') }}" placeholder="Enter Category" />
                @error('category')
                    <p class="text-red-800"> {{ $message }} </p>
                @enderror
            </div>
            <div class="dosage name">
                <x-label for="name" value="{{ __('Dosage Form') }}" />
                <x-input id="dosage" class="block mt-1 w-full uppercase uppercase-transform" type="text"
                    name="dosage" value="{{ old('dosage') }}" placeholder="Enter Dosage" />
                @error('dosage')
                    <p class="text-red-800"> {{ $message }} </p>
                @enderror
            </div>

            <div>
                <x-button class="text-center">Submit</x-button>
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
                    Brand Name
                </th>
                <th scope="col" class="px-6">
                    molecule
                </th>
                <th scope="col" class="px-6">
                    dosage
                </th>
                <th scope="col" class="px-6">
                    Category
                </th>
                {{-- <th scope="col" class="px-6">
                    Action
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @php
                $n = 0;
            @endphp
            @foreach ($data as $post)
                <tr>
                    <td class="px-6 py-4">
                        {{ $n = $n + 1 }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->brand_name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $post->molecule }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->dosage_form }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->category }}
                    </td>
                    {{-- <td class="px-6 py-4">
                        <x-button>Edit</x-button>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-5" style="margin: 10px !important"></div>
    {{ $data->links() }}

   

    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
        $(function() {
            // Function to fetch tags from the database
            // function getTags(request, response) {
            //     $.ajax({
            //         type: 'GET',
            //         url: '{{ route('rec.get_medicines') }}', // Replace with your API or route URL
            //         dataType: 'json',
            //         data: {
            //             term: request.term
            //         },
            //         success: function(data) {
            //             response(data);
            //         }
            //     });
            // }

            function getCategory(request, response) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('rec.get_medicines') }}', // Replace with your API or route URL
                    dataType: 'json',
                    data: {
                        category: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            }

            function getDosage(request, response) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('rec.get_medicines') }}', // Replace with your API or route URL
                    dataType: 'json',
                    data: {
                        dose: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            }

            // Initialize the autocomplete widget
            // $("#b_name").autocomplete({
            //     source: getTags // Use the getTags function as the source
            // });

            $("#category").autocomplete({
                source: getCategory // Use the getTags function as the source
            });

            $("#dosage").autocomplete({
                source: getDosage // Use the getTags function as the source
            });

            $(".uppercase-transform").keyup(function() {
                var inputField = $(this);
                inputField.val(inputField.val().toUpperCase()); // Convert the input value to uppercase
            });
        });
    </script>
</x-app-layout>
