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
                        <div class="flex">
                            <input type="text" name="content" class="flex-1 p-2 border border-gray-300 dark:border-gray-700 rounded-lg" placeholder="メッセージを入力..." required>
                            <input type="text" name="" class="flex-1 p-2 border border-gray-300 dark:border-gray-700 rounded-lg" placeholder="メッセージを入力..." required>
                            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg disabled:opacity-60" disabled>送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
