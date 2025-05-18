@props(['postUser', 'createdAt', 'text', 'imageSrc' => ''])

@php
    $bgColor = 'bg-gray-300';
    if (Auth::user()->name == $postUser) {
        $bgColor = 'bg-blue-200';
    }
@endphp

<div class="flex w-full mt-2 space-x-3 max-w-xs">
    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
        {{-- <img alt="User Image" src="{{ $imageSrc }}" /> --}}
    </div>
    <div class="flex flex-col gap-1">
        <div class="flex flex-row gap-1 text-xs leading-none">
            <span class="">{{ $postUser }}</span>
            <span class="text-gray-500">{{ $createdAt }}</span>
        </div>
        <div class="{{ $bgColor }} p-3 rounded-r-lg rounded-bl-lg">
            <p class="text-sm">{!! nl2br(e($text)) !!}</p>
        </div>
    </div>
</div>
