<?php
/**
 * Created by PhpStorm.
 * User: quangquyet
 * Date: 22/12/2018
 * Time: 08:43
 */

namespace App\Providers;
use Illuminate\Support\Facades\Cache;

class CacheLog
{
    const TIME = 60*60*24*365;
    /**
     * @param $tableName
     * @param $val
     * @return bool
     */
    public static function setToTable($tableName, $val){
        //kiem tra xem bang nay da khoi tao bao gio chua
        $next_key =0;
        $current_key = Cache::store('file')->get('current_key_'.$tableName);


        if(!$current_key || $current_key==NULL || empty($current_key)){
            $current_key = 0;
        }

        $next_key = $current_key + 1;
        //$val.='<br/><span style="color:green;font-size:12px">'.date ( "d/m/y - H:i:s", time () ).'</span>';
        $mc = Cache::store('file')->put($tableName.$next_key, $val, self::TIME);
        Cache::store('file')->put('current_key_'.$tableName, $next_key, self::TIME);
        return TRUE;
    }

    /**
     * @param $tableName
     * @return array|bool
     */
    public static function getTable($tableName){
        //kiem tra xem bang nay da khoi tao bao gio chua
        $current_key = Cache::store('file')->get('current_key_'.$tableName);
        $val_list = array();
        $val_list[]='Begin';
        if(!$current_key || $current_key==NULL || empty($current_key)){
            return FALSE;
        }

        for($i=1; $i<=$current_key; $i++){
            $val_list[] = Cache::store('file')->get($tableName.$i);
        }
        return $val_list;
    }

    /**
     * @param $tableName
     * @return array|bool
     */
    public static function delTable($tableName){
        //kiem tra xem bang nay da khoi tao bao gio chua
        $current_key = Cache::store('file')->get('current_key_'.$tableName);
        $val_list = array();
        $val_list[]='Begin';

        if(!$current_key || $current_key==NULL || empty($current_key)){
            return FALSE;
        }

        for($i=1; $i<=$current_key; $i++){
            $val_list[] = Cache::store('file')->forget($tableName.$i);
        }
        Cache::store('file')->forget('current_key_'.$tableName);
        return $val_list;
    }
}
