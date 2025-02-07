<?php

namespace App\Http\Controllers;

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

        $participants[] = $nickname;
        
        Cache::put('participants', $participants);

        broadcast(new UserJoined($nickname, $participants));

        return response()->json([
            'message' => "$nickname joined the room!" . ($isAdmin ? "(Administrador)." : "")
        ]);
    }
}
