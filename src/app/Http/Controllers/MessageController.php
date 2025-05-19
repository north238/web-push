<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * @var User $users
     */
    protected $users;
    /**
     * @var Message $messages
     */
    protected $messages;
    /**
     * @var MessageService $messageServices
     */
    protected $messageServices;

    public function __construct(User $users, Message $messages, MessageService $messageServices)
    {
        $this->users = $users;
        $this->messages = $messages;
        $this->messageServices = $messageServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // メッセージ一覧を取得
        $messages = $this->messages->getMessageList();

        return view('message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageCreateRequest $request)
    {
        $validated = $request->validated();

        try {
            // ファイルの保存
            if ($request->hasFile('file_path')) {
                $file = $validated['file_path'];
                $filePath = $this->messageServices->saveFile($file);
                $validated['file_path'] = $filePath;
            }

            // ユーザーIDを取得
            // $receiveUserName = $validated['receive_user_name'];
            // $receiveUserId = $this->users->getUserByName($receiveUserName);
            // if (!$receiveUserId) {
            //     Log::error('【メッセージ】ユーザー該当なし', [
            //         'validated' => $validated
            //     ]);
            //     return back()->with('error', 'ユーザーが存在しません');
            // }

            // $validated['receive_user_id'] = $receiveUserId;
            $validated['post_user_id'] = auth()->id();

            // メッセージの保存
            $message = $this->messages->createMessage($validated);
            if (!$message) {
                throw new Exception('メッセージの保存に失敗しました');
            }

            return back()->with('success', 'メッセージを送信しました');
        } catch (Exception $e) {
            report($e);

            return back()->with('error', 'メッセージ送信に失敗しました');
        }
    }

    /**
     * メッセージ画像を保存する
     */
    public function sendImageMessage(Request $request)
    {
        $dataUrl = $request->input('image');

        if (!preg_match('/^data:image\/svg\+xml;base64,/', $dataUrl)) {
            return response()->json(['error' => 'Invalid image format.'], 400);
        }

        $imageData = base64_decode(str_replace('data:image/svg+xml;base64,', '', $dataUrl));

        $filename = 'messages_image' . time() . '.svg';
        $path = storage_path('app/public/messages/' . $filename);

        Storage::put($path, $imageData);

        $saveData = [
            'file_path' => $path,
            'post_user_id' => $request->user()->id,
        ];
        $messageImage = $this->messages->createMessage($saveData);

        return response()->json(['message' => 'Saved', 'path' => $messageImage->file_path]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
