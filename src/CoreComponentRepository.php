<?php

namespace MehediIitdu\CoreComponentRepository;

class CoreComponentRepository
{
    public static function instantiateShopRepository() {
        $url = $_SERVER['SERVER_NAME'];
        $gate = "http://206.189.81.181/check_activation/".$url;
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
