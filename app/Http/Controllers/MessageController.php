<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessages()
    {
        $data = Message::get()->map(function ($c) {
            $user = User::where('id', $c->user_id)->first();
            return [
                'id'        => $c->id,
                'user_name' => $user->username,
                'message'   => ($c->message),
            ];
        });

        return response()->json($data);
    }

    public function insertMessages(Request $requeset)
    {
        $data = $requeset->all();
        $user = User::where('username', $data['login'])->first();
        if ($user and isset($data['message'])) {
            Message::forceCreate([
                'message' => $data['message'],
                'user_id' => (int) $user->id,
            ]);
            return response(['Sucsses', 200]);

        } else {
            return response(['User not found'], 500);
        }

    }

    public function delete($id)
    {
        $message = Message::where('id', (int) $id)->first();
        if ($message) {
            $message->delete();
            return response(['Sucsses'], 200);
        } else {
            return response(['Сообщение не найдено'], 500);
        }
    }

}
