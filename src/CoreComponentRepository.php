<?php

namespace MehediIitdu\CoreComponentRepository;

class CoreComponentRepository
{
    public static function instantiateShopRepository() {
        $url = $_SERVER['SERVER_NAME'];
        //Converts URL to main domain name
        // $pieces = parse_url($url);
        // $domain = isset($pieces['host']) ? $pieces['host'] : '';
        // if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        //     $url =  $regs['domain'];
        // }
        // $url =  $pieces['path'];

        $gate = "https://activeitzone.com/check/index.php/home/check_l/".$url;
        $rn = self::serializeObjectResponse($gate);
        self::finalizeRepository($rn);
    }

    protected static function serializeObjectResponse($zn) {
        $stream = curl_init();
        curl_setopt($stream, CURLOPT_URL, $zn);
        curl_setopt($stream, CURLOPT_HEADER, 0);
        curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($stream, CURLOPT_POST, 1);
        $rn = curl_exec($stream);
        curl_close($stream);
        return $rn;
    }

    protected static function finalizeRepository($rn) {
        if($rn == "bad" && env('DEMO_MODE') != 'On') {
            return redirect('https://activeitzone.com/check/')->send();
        }
    }
}
