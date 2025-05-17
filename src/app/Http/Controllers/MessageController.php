<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
