<?php

namespace  FelipeMateus\IPTVCustomers\Middleware;

use Closure;
use Illuminate\Http\Request;
use FelipeMateus\IPTVCustomers\Models\IPTVCustomer;
use FelipeMateus\IPTVChannels\Model\IPTVConfig;

class CustomerMiddleware
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $AUTH_USER = 'admin';
        $AUTH_PASS = 'admin';
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        /*$has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $is_not_authenticated = (
            !$has_supplied_credentials ||
            $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
        );*/
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

        if($has_supplied_credentials){
            $custormer =IPTVCustomer::where("username",$_SERVER['PHP_AUTH_USER'])->where('hash_acess',$_SERVER['PHP_AUTH_PW'])->first();
            $request->custormer = $custormer;
        }

        $is_not_authenticated = (
            !$has_supplied_credentials ||
            !isset($custormer)
        );

        if ($is_not_authenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            echo "This operation is unthorizated!";
            exit();
        }
        return $next($request);
    }
}
