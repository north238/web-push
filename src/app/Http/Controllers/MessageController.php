<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageCreateRequest;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            broadcast(new MessageSent($message))->toOthers();

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
            return response()->json(['error' => 'ファイル形式が異なります'], 400);
        }

        $path = $this->messageServices->saveFile($dataUrl);

        $saveData = [
            'file_path' => $path,
            'post_user_id' => Auth::user()->id,
        ];
        $message = $this->messages->createMessage($saveData);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => 'ファイル保存が完了しました', 'path' => $message->file_path]);
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
