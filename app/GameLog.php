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
}
