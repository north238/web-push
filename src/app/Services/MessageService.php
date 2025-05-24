<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MessageService
{
    /**
     * ファイルを保存する
     * - 画像データを受け取り、指定のパスに保存する
     * - ファイル名は現在の日時を組み合わせて生成
     * - ファイルパスはユーザーIDを基に生成
     */
    public function saveFile(string $imageData): string
    {
        $fileName = 'image_' . now()->format('Ymd_His') . '.svg';

        // ファイルパスを生成
        $userId = Auth::user()->id;
        $filePath = 'messages/' . $userId . '/' .  $fileName;

        [$meta, $content] = explode(',', $imageData);
        $decodedData = base64_decode($content);

        Storage::disk('public')->put($filePath, $decodedData);

        return $filePath;
    }
}
