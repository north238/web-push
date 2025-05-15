<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            チャット
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <div class="overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white dark:bg-gray-800">
                                <div class="flex flex-col">
                                    @foreach ($messages as $message)
                                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                            {{-- <strong>{{ $message->->name }}</strong> --}}
                                            <p>{{ $message->text }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('message.store') }}" class="mt-4">
                        @csrf
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                            <x-text-input id="receive-user-text" type="text" name="receive_user_name" class="h-10" placeholder="受信者を入力..." required  autofocus/>
                            <x-textarea id="message-text" name="text" class="flex-1 h-20" required></x-textarea>
                            <x-primary-button id="message-send-btn" class="ml-4 h-10" disabled>
                                送信
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite(['resources/js/message.js'])