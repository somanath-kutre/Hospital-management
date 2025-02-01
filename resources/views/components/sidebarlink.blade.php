@props(['title' => $title, 'link' => $link,'active' => false])

@php
$classes = ($active)
    ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-500 text-base dark:text-blue-800 font-medium text-indigo-700 bg-indigo-50 dark:bg-blue-200 dark:text-blue-900 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
    : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base  font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp


<a href="{{$link}}" class="{{ $classes }} flex items-center p-2 text-gray-900 hover:text-indigo-900 dark:hover:text-white rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
    {{-- {{$icon}} --}}
     {{-- {{$slot}} --}}
    <span class="flex-1 ml-3 whitespace-nowrap">{{$title}}</span>
    {{-- <span class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span> --}}
 </a>