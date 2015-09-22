<?php

/*
 * DataControl
 * Various of data manipulations
 * DISCLAIMER: Some codes has 3rd party rights
 */

class DataControl {

    /**
     * Calculate age in years based on timestamp and reference timestamp
     *
     * @param int $starttime
     * @param int $endtime
     * @return int
     *
     * Source: shanelabs.com/blog/2008/03/26/calculating-age-from-unix-timestamps-in-php/
     */
    public static function computeAge($starttime, $endtime = false)
    {
        if ($endtime = false) {
            $endtime = time();
        }
        $age = date("Y",$endtime) - date("Y",$starttime);
        //if birthday didn't occur that last year, then decrement
        if(date("z",$endtime) < date("z",$starttime)) $age--;
        return $age . ' year/s';
    }

    /**
     * Calculate time elapsed based on timestamp
     *
     * @param int $ptime
     * @return string
     *
     * Source: http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
     */
    public static function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return 'Just now';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );
        $a_plural = array( 'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

}