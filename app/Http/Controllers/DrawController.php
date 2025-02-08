<?php

namespace App\Http\Controllers;

use App\Events\DrawStarted;
use App\Events\UserJoined;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DrawController extends Controller
{
    public function enter(Request $request) {
        $nickname = $request->input('nickname');

        $participants = Cache::get('participants', []);

        if (in_array($nickname, $participants)) {
            return response()->json(['message' => "This nickname is already in the room."], 400);
        }
        
        $isAdmin = $nickname === "admin123";

        $onlyUsers = array_filter($participants, function($participant) {
            return $participant !== "admin123";
        });
        
        if (count($onlyUsers) > env('MAX_PARTICIPANTS_COUNT')) {
            return response()->json(['message' => "The room is full."]);
        }

        $participants[] = $nickname;
        
        Cache::put('participants', $participants, now()->addMinutes(10));

        broadcast(new UserJoined($nickname, $participants));

        return response()->json([
            'message' => $isAdmin ? "The admin joined the room!" : "$nickname joined the room!"
        ]);
    }

    public function start() {
        $participants = Cache::get('participants');

        $onlyUsers = array_filter($participants, function($participant) {
            return $participant !== "admin123";
        });

        if(count($onlyUsers) === env("MAX_PARTICIPANTS_COUNT")) {
            $winner = $onlyUsers[array_rand($onlyUsers)];
            
            broadcast(new DrawStarted($winner));

            return response()->json(['message' => 'We have a winner!']);
        }else {
            return response()->json(['message' => 'The room is not full yet.']);
        }
    }
}
