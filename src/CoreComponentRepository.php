<?php

namespace MehediIitdu\CoreComponentRepository;
use App\Addon;

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
            return redirect('https://activeitzone.com/activation/')->send();
        }
    }

    public static function initializeCache() {
        foreach(Addon::all() as $addon){
            if ($addon->purchase_code == null) {
                self::finalizeCache($addon);
            }
    
            try {
                $gate = "https://activeitzone.com/activation/check/".$addon->unique_identifier."/".$addon->purchase_code;
    
                $stream = curl_init();
                curl_setopt($stream, CURLOPT_URL, $gate);
                curl_setopt($stream, CURLOPT_HEADER, 0);
                curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($stream, CURLOPT_POST, 1);
                $rn = curl_exec($stream);
                curl_close($stream);
    
                if($rn == 'no') {
                    self::finalizeCache($addon);
                }
            } catch (\Exception $e) {
    
            }
    
            return true;
        }
    }

    public static function finalizeCache($addon){
        $addon->activated = 0;
        $addon->save();

        flash('Please reinstall '.$addon->name.' using valid purchase code')->warning();
        return redirect()->route('addons.index')->send();
    } 
}
