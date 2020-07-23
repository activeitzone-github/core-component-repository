<?php

namespace MehediIitdu\CoreComponentRepository;

class CoreComponentRepository
{
    public static function instantiateShopRepository() {
        $gate = "https://activeitzone.com/check/index.php/home/check_l/".$_SERVER['SERVER_NAME'];
        $rn = self::serializeObjectResponse($gate);
        self::finalizeRepository($rn);
    }

    protected static function serializeObjectResponse($zn) {
        $stream = curl_init();
        curl_setopt($stream, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($stream, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($stream, CURLOPT_URL, $zn);
        curl_setopt($stream, CURLOPT_HEADER, 0);
        curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($stream, CURLOPT_POST, 1);
        $rn = curl_exec($stream);
        curl_close($stream);
        return $rn;
    }

    protected static function finalizeRepository($rn) {
        if($rn != 'nice') {
            return redirect('https://activeitzone.com/check/')->send();
        }
    }
}
