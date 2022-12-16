<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use YieldStudio\LaravelExpoNotifier\Dto\ExpoMessage;

class ChatController extends Controller
{
    public function getChats(Request $request)
    {
        $data = [];
        $user = $request->user();
        if (!isset($user->name)) {
            return response()->json(null, 500);
        }
        $conversation = $user->Coversations()->first();
        if (!isset($conversation->name)) {
            return response()->json(null, 500);
        }
        foreach ($conversation->Chats()->get() as $chat) {
            $item = new \stdClass();
            $item->id = $chat->id;
            $item->message = $chat->message;
            $item->type = $chat->type;
            $item->attachment = $chat->attachment;
            $item->status = $chat->from_id == $user->id ? "send" : "received";
            $data[] = $item;
        }
        return $data;
    }

    public function sendChat(Request $request)
    {
        $user = $request->user();
        if (!isset($user->name)) {
            return response()->json(null, 500);
        }
        $data = [
            'message' => $request->message ?? null,
            'type' => $request->type ?? "text",
            'attachment' => $request->attachment ?? null,
            'from_id' => $user->id,
            'conversation_id' => $request->conversation_id ?? 1,
        ];
        try {
            $store = Chat::create($data);
            $conversation = Conversation::where("id", $data["conversation_id"])->first();
            $notifyUser = $conversation->Users()->where("id", "!=", $user->id)->get();
            foreach ($notifyUser as $sendUser) {
                $devices = $sendUser->Devices()->get();
                foreach ($devices as $device) {
                    $body = json_encode([
                        "to" => $device->token,
                        "title" => $user->name . " đã gửi tin nhắn",
                        "body" => $data["message"],
                        "channelId" => 'default',
                        "data" => json_encode([
                            "type" => "chat",
                            "chat" => $data,
                        ])
                    ]);
                    $response = Http::withBody($body, 'application/json')->post('https://exp.host/--/api/v2/push/send');
                }
            }
            return response()->json([
                'id' => $store->id,
            ], 200);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function conversation(Request $request)
    {
        $user = $request->user();
        if (!isset($user->name)) {
            return response()->json(null, 500);
        }
        if (!isset($request->id)) {
            return response()->json(null, 500);
        }
        $conversation = Conversation::where("id", $request->id)->first();
        if (!isset($conversation->name)) {
            return response()->json(null, 500);
        }
        return $conversation;
    }
}
