<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use GeoIp2\Database\Reader;

class Ban
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('helpers.ban.enable')) {
            //ban user id
            $userId = optional(Auth::user())->id;
            if (config('helpers.ban.user_id_ban_enable') && $userId) {
                if (\App\Models\Ban::where('user_id', $userId)->first()) {
                    throw new \ErrorException("Your device or account is blocked");
                }
            }

            if (config('helpers.ban.ip_ban_enable')) {
                //ban ip
                $ip = last(request()->getClientIps());
                $info = geoip($ip)->toArray();
                $findBanUser = \App\Models\Ban::where('ip', $info['ip'])->first();
                if ($findBanUser) {
                    throw new \ErrorException("Your device or account is blocked");
                }
            }

            //ban mac
        }

        return $next($request);
    }
}
