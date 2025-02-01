@props(['options' => [], 'oldValue' => null,'title' => ''])
<div class="my-1">
    <select {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full']) }}>
        <option selected>{{ $title }}</option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}"  @if($oldValue === $value)selected @endif>{{ $label }}</option>
        @endforeach
    </select>
</div>
