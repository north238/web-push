<x-app-layout>
    <div class="container mx-auto mt-10 max-w-2xl">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">見積書作成フォーム</h1>

            <form action="{{ route('documents.download') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="company" class="block text-gray-700 text-sm font-bold mb-2">
                        会社名（宛先）
                    </label>
                    <input type="text" id="company" name="company" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        発行者名
                    </label>
                    <input type="text" id="name" name="name" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="body" class="block text-gray-700 text-sm font-bold mb-2">
                        内容（品目など）
                    </label>
                    <textarea id="body" name="body" rows="5" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>

                <div class="flex items-center justify-center">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        PDFをダウンロード
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
