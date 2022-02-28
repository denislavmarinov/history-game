<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GameLog extends Model
{
    public static function add_game_log($data)
    {
        return DB::table("game_logs")
                ->insert($data);
    }

    public static function get_last_5_logs_for_user($user)
    {
        return DB::table("game_logs")
            ->select("points", "status",  "game_completion_time", "started_at")
            ->where("user", '=', $user)
            ->orderBy("started_at", 'DESC')
            ->limit(5)
            ->get();
    }
}
