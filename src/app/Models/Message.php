<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * カラム名
     */
    protected $fillable = [
        'text',
        'file_path',
        'post_user_id',
        'receive_user_id',
    ];

    /**
     * リレーション
     */
    public function postUser()
    {
        return $this->belongsTo(User::class, 'post_user_id');
    }
    public function receiveUser()
    {
        return $this->belongsTo(User::class, 'receive_user_id');
    }

    /**
     * 作成日を指定フォーマットで取得するアクセサ
     *
     * @return string フォーマット済みの作成日時
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('Y/m/d H:i');
    }

    /**
     * 作成日を「〇分前」「〇時間前」などの相対表記で取得するアクセサ
     *
     * @return string 相対的な時間表記
     */
    public function getDiffCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * 指定したタイプのユーザー名を取得（投稿者または受信者）
     */
    public function getAttributeFormattedUser($type = 'post')
    {
        // リレーション名を決定
        $relation = $type === 'receive' ? 'receiveUser' : 'postUser';

        // リレーションが既に読み込まれているか確認
        if ($this->relationLoaded($relation)) {
            $user = $this->$relation;
        } else {
            // リレーションが読み込まれていない場合は読み込む
            $user = $this->$relation()->first();
        }

        // ユーザーが存在しない場合
        if (!$user) {
            return '不明なユーザー';
        }

        // ユーザーモデルから名前を構築（ユーザーモデルの構造に合わせて調整）
        if (isset($user->name)) {
            return $user->name;
        }
    }

    /**
     * 投稿者の名前を取得するアクセサ
     */
    public function getFormattedPostUserAttribute()
    {
        return $this->getAttributeFormattedUser('post');
    }

    /**
     * 受信者の名前を取得するアクセサ
     */
    public function getFormattedReceiveUserAttribute()
    {
        return $this->getAttributeFormattedUser('receive');
    }

    /**
     * メッセージ一覧を取得
     */
    public function getMessageList()
    {
        return $this->with(['postUser', 'receiveUser'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * メッセージを保存
     */
    public function createMessage(array $data)
    {
        return $this->create($data);
    }
}
