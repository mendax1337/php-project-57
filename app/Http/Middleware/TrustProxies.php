<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Trust all proxies (Render / любой reverse-proxy).
     * Можно сузить до конкретных IP.
     */
    protected $proxies = '*';

    /**
     * Заголовки прокси, которые учитываются фреймворком.
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR
    | Request::HEADER_X_FORWARDED_HOST
    | Request::HEADER_X_FORWARDED_PORT
    | Request::HEADER_X_FORWARDED_PROTO
    | Request::HEADER_X_FORWARDED_AWS_ELB;
}
