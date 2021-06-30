<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Auth;
use Cache;

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

            $message=config('helpers.ban.exception_message');
            $exceptionType=config('helpers.ban.exception_type');


            //ban user id
            $userId = optional(Auth::user())->id;
            if (config('helpers.ban.user_id_ban_enable') && $userId) {
                if (\App\Models\Ban::where('user_id', $userId)->where('ban_deleted','>', Carbon::now())->first()) {
                    return response()->view('helpers.errors', ['exception' => $message], 302);
                }
            }

            if (config('helpers.ban.ip_ban_enable')) {
                //ban ip
                $ip = last(request()->getClientIps());
                $info = geoip($ip)->toArray();
                $findBanUser = \App\Models\Ban::where('ip', $info['ip'])->where('ban_deleted','>', Carbon::now())->first();
                if ($findBanUser) {
                    return response()->view('helpers.errors', ['exception' => $message], 302);
                }
            }

            if (config('helpers.ban.mac_ban_enable')) {
                //ban mac

            }
        }
        return $next($request);
    }
}
