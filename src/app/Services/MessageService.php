<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class MessageService
{
    /**
     * ファイルを保存する
     */
    public function saveFile(object $file): string
    {
        $fileName = now()->timestamp . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('messages', $fileName, 'public');

        Log::info('【メッセージ作成】ファイル保存処理', [
            'file_path' => $filePath,
            'file_name' => $fileName,
        ]);

        return $filePath;
    }
}
