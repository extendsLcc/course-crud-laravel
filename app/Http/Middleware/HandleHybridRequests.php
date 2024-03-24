<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Data\SecurityData;
use App\Data\SharedData;
use App\Data\UserData;
use Closure;
use Hybridly\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HandleHybridRequests extends Middleware
{
    /**
     * Defines the properties that are shared to all requests.
     */
    public function share(): SharedData
    {
        return SharedData::from([
            'security' => SecurityData::from([
                'user' => UserData::optional(auth()->user()),
            ]),
            'currentRouteName' => request()->route()->getName(),
        ]);
    }
}
