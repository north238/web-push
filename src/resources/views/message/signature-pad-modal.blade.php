<section id="signature-section" class="fixed inset-0 top-0 left-0 w-screen h-screen hidden bg-white/80">
    <div class="flex flex-col items-center p-3">
        <div class="wrapper">
            <canvas id="signature-pad" class="signature-pad"></canvas>
        </div>

        <div>
            <div class="flex">
                <div class="flex flex-col text-center gap-1 m-2">
                    <button id="save-svg"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg></button>
                    <span class="font-bold text-xs">送信</span>
                </div>
                <div class="flex flex-col text-center gap-1 m-2">
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
                    <span class="font-bold text-xs">書く</span>
                </div>
                <div class="flex flex-col text-center gap-1 m-2">
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
                    <span class="font-bold text-xs">消す</span>
                </div>
                <div class="flex flex-col text-center gap-1 m-2">
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
                    <span class="font-bold text-xs">戻す</span>
                </div>
                <div class="flex flex-col text-center gap-1 m-2">
                    <button id="clear"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-backspace">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5z" />
                            <path d="M12 10l4 4m0 -4l-4 4" />
                        </svg>
                    </button>
                    <span class="font-bold text-xs">クリア</span>
                </div>
                <div class="flex flex-col text-center gap-1 m-2">
                    <button id="close-signature"
                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 disabled:opacity-50 transition">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10l4 4m0 -4l-4 4" />
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        </svg>
                    </button>
                    <span class="font-bold text-xs">閉じる</span>
                </div>
            </div>
        </div>
    </div>
</section>
