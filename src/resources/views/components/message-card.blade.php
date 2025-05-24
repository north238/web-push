@props(['postUser', 'createdAt', 'text', 'image', 'imageSrc' => ''])

@php
    // 送信者と受信者でデザインを切り替える
    $isPostUser = Auth::user()->name == $postUser;
    $bgColor = 'bg-blue-300 rounded-r-lg rounded-bl-lg';
    $flexClass = 'justify-start';
    $isHidden = '';
    if ($isPostUser) {
        $flexClass = 'justify-end';
        $bgColor = 'bg-gray-200 rounded-l-lg rounded-br-lg';
        $isHidden = 'hidden';
    }
@endphp

<div class="flex w-full mt-2 space-x-3 {{ $flexClass }}">
    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-300 {{ $isHidden }}">
        <div class="flex items-center justify-center h-full w-full">
            <img alt="User Image" src="{{ asset('images/default-user.svg') }}" />
        </div>
    </div>
    <div class="flex flex-col gap-1">
        <div class="flex flex-row gap-1 text-xs leading-none {{ $flexClass }}">
            <span class="">{{ $postUser }}</span>
            <span class="text-gray-500">{{ $createdAt }}</span>
        </div>
        <div class="{{ $bgColor }} p-3">
            @if (empty($text))
                <img src="{{ asset('storage/' . $image) }}" alt="image">
            @else
                <p class="text-sm">{!! nl2br(e($text)) !!}</p>
            @endif
        </div>
    </div>
</div>
