<?php

namespace App\Helpers;
use DB;
class AutoNumber
{
	public static function autoNumber($table,$primary,$prefix, $temp, $temps){
        $q=DB::table($table)->select(DB::raw('MAX(RIGHT('.$primary.',4)) as kd_max'))->where($temp,$temps);
        $prx=$prefix;
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = $prx."0001";
        }

        return $kd;
    }
}
?>
