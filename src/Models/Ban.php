<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{

    protected $table = 'ban';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ip',
        'mac',
        'user_id',
        'ban_deleted_at',
    ];

    public function user()
    {
        return $this->hasOne(config('helpers.ban.user_model'), config('helpers.ban.user_model_primary_key_id'));
    }

    public static function ipBan($ip, $banTime)
    {
        $isExists=self::where('ip',$ip)->first();
        if($isExists){
            $isExists->ban_deleted_at=$banTime;
            $isExists->save();
        }else{
            self::create([
                'ip' => $ip,
                'ban_deleted_at' => $banTime
            ]);
        }
    }

    public static function userBan($userId, $banTime)
    {
        $isExists=self::where('user_id',$userId)->first();
        if($isExists){
            $isExists->ban_deleted_at=$banTime;
            $isExists->save();
        }else{
            self::create([
                'user_id' => $userId,
                'ban_deleted_at' => $banTime
            ]);
        }
    }

    public static function macBan($mac, $banTime)
    {
        $isExists=self::where('mac',$mac)->first();
        if($isExists){
            $isExists->ban_deleted_at=$banTime;
            $isExists->save();
        }else{
            self::create([
                'mac' => $mac,
                'ban_deleted_at' => $banTime
            ]);
        }
    }

    public static function liftBan($value, $type)
    {
        switch ($type) {
            case 'ip':
                self::where('ip', $value)->delete();
                break;
            case 'mac':
                self::where('mac', $value)->delete();
                break;
            case 'user':
                self::where('user_id', $value)->delete();
                break;
        }
        return true;
    }
}
