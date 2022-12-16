<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Conversation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conversation = [
            'name' => "Đoạn chat của Lan vs Ling",
        ];
        $newConversation = Conversation::create($conversation);
        DB::table("user_conversation")->insert(
            [
                'user_id' => 1,
                'conversation_id' => $newConversation->id,
            ]
        );
        DB::table("user_conversation")->insert(
            [
                'user_id' => 2,
                'conversation_id' => $newConversation->id,
            ]
        );
        $send = [
            'message' => 'Chào bạn, tôi là chú báo con',
            'from_id' => 1,
            'to_id' => 2,
            'type' => 'text',
            'conversation_id' => $newConversation->id,
        ];
        $received = [
            'message' => 'Chào bạn, tôi là chú báo con',
            'from_id' => 1,
            'to_id' => 2,
            'type' => 'text',
            'conversation_id' => $newConversation->id,
        ];
        Chat::create($send);
        Chat::create($received);
    }
}
