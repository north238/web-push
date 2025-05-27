<x-app-layout>
    <div class="flex flex-col h-[calc(100dvh-64px)] min-h-[calc(100dvh-64px)]">
        <div class="flex-1 overflow-y-auto p-2">
            <div class="max-w-4xl mx-auto space-y-4">
                <div id="message-list"
                    class="flex flex-col w-full p-2 text-gray-900 bg-white rounded shadow-sm ">
                    @foreach ($messages as $message)
                        <x-message-card :post-user="$message->formatted_post_user" :created-at="$message->diff_created_at" :text="$message->text" :image="$message->file_path"
                            :image-src="$message->postUser->profile_image ?? ''" />
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white border-t p-2 h-[72px]">
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
                <div class="flex flex-col items-center gap-1">
                    <button type="button" id="write-pad-btn"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" />
                            <path d="M16 7h4" />
                            <path d="M18 19h-13a2 2 0 1 1 0 -4h4a2 2 0 1 0 0 -4h-3" />
                        </svg>
                    </button>
                    <span class="font-bold text-xs">書く</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <button type="submit" id="message-send-btn"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition"
                        disabled>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                    <span class="font-bold text-xs">送信</span>
                </div>
            </form>
        </div>
    </div>

    @include('message.signature-pad-modal')
</x-app-layout>

@vite(['resources/js/message.js', 'resources/js/pusher.js', 'resources/js/signature-pad.js'])
