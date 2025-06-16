@props(['type' => 'text'])

<input {{ $attributes->merge([
    'type' => $type,
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
]) }}>