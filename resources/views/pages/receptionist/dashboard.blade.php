<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div> --}}

    <div class="py-5">
        <div class="mx-auto sm:px-6 lg:px-8 py-5 ">
            <p class="text-2xl font-medium text-red-900 ">Patients</p>
            <div class="border-b border-red-900 mt-2"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mx-auto my-3 sm:px-6 lg:px-8">
            <div class="bg-emerald-100 py-4 rounded text-center shadow">
                <h2 class="font-medium text-emerald-900 text-lg">Total Patients</h2>
                <p class="mt-2 font-medium text-2xl"> {{$tot_patients}}</p>
            </div>

            <div class="bg-emerald-100 py-4 rounded text-center shadow">
                <h2 class="font-medium text-emerald-900 text-lg">Total OPD Registers</h2>
                <p class="mt-2 font-medium text-2xl">{{$opd_counts}}</p>
            </div>

            <div class="bg-emerald-100 py-4 rounded text-center shadow">
                <h2 class="font-medium text-emerald-900 text-lg">Total IPD Registers</h2>
                <p class="mt-2 font-medium text-2xl">{{$ipd_counts}}</p>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="mx-auto sm:px-6 lg:px-8 py-5  rounded">
            <p class="text-2xl font-medium text-red-900 ">Payments</p>
            <div class="border-b border-red-900 mt-2"></div>
           
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 mx-auto my-3 sm:px-6 lg:px-8">
            <div class="bg-emerald-100 py-4 rounded text-center shadow">
                <h2 class="font-medium text-emerald-900 text-lg">Today Total Payment</h2>
                <p class="mt-2 font-medium text-2xl"><span class="text-xl">&#8377;</span> {{$total_cash}}</p>
            </div>

            <div class="bg-emerald-100 py-4 rounded text-center shadow">
                <h2 class="font-medium text-emerald-900 text-lg">Today Total Payment In <strong>Cash</strong></h2>
                <p class="mt-2 font-medium text-2xl"><span class="text-xl">&#8377;</span> {{$tot_cash}}</p>
            </div>

            <div class="bg-emerald-100 py-4 rounded text-center shadow">
                <h2 class="font-medium text-emerald-900 text-lg">Today Total Payment In <strong>UPI</strong></h2>
                <p class="mt-2 font-medium text-2xl"><span class="text-xl">&#8377;</span> {{$upi}}</p>
            </div>
        </div>
    </div>

 
   
</x-app-layout>
