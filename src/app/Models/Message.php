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
}
