<x-app-layout>
    <div class="flex flex-col h-[calc(100vh-64px)] min-h-[calc(100vh-64px)]">
        <div class="flex-1 overflow-y-auto p-2">
            <div class="max-w-4xl mx-auto space-y-4">
                <div class="p-2 text-gray-900 bg-white rounded shadow-sm dark:text-gray-100">
                    @foreach ($messages as $message)
                        <x-message-card :post-user="$message->formatted_post_user" :created-at="$message->diff_created_at" :text="$message->text" :image-src="$message->postUser->profile_image ?? ''" />
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white border-t p-2">
            <form method="POST" action="{{ route('message.store') }}"
                class="max-w-4xl mx-auto flex justify-center items-center gap-2">
                @csrf
                {{-- <div class="w-full">
                        <x-text-input id="receive-user-text" type="text" name="receive_user_name" class="w-full h-10"
                            placeholder="受信者を入力..." required autofocus />
                        <x-input-error :messages="$errors->get('receive_user_name')" class="mt-2" />
                    </div> --}}
                <div class="w-full">
                    <x-text-input id="message-text" name="text" class="w-full h-12" required />
                </div>
                <button type="button" id="write-pad-btn" class="p-2 text-gray-500 hover:text-gray-700 transition"
                    x-data="" x-on:click="$dispatch('open-modal', 'signature-pad-modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" />
                        <path d="M16 7h4" />
                        <path d="M18 19h-13a2 2 0 1 1 0 -4h4a2 2 0 1 0 0 -4h-3" />
                    </svg>
                </button>
                <button type="submit" id="message-send-btn"
                    class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition"
                    disabled>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <section>
        <div class="flex items-center">
            <div class="wrapper">
                <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
            </div>
            <div>
                <div class="m-2">
                    <button id="save-svg"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg></button>
                </div>
                <div class="m-2">
                    <button id="draw"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" />
                            <path d="M16 7h4" />
                            <path d="M18 19h-13a2 2 0 1 1 0 -4h4a2 2 0 1 0 0 -4h-3" />
                        </svg>
                    </button>
                </div>
                <div class="m-2">
                    <button id="erase"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-eraser">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" />
                            <path d="M18 13.3l-6.3 -6.3" />
                        </svg>
                    </button>
                </div>
                <div class="m-2">
                    <button id="undo"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 14l-4 -4l4 -4" />
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                        </svg>
                    </button>
                </div>
                <div class="m-2">
                    <button id="clear"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-clear-all">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 6h12" />
                            <path d="M6 12h12" />
                            <path d="M4 18h12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <x-modal name="signature-pad-modal" focusable>
        @include('message.signature-pad-modal')
    </x-modal>
</x-app-layout>

@vite(['resources/js/message.js', 'resources/js/signature-pad.js'])
