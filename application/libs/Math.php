<?php

/**
 * Math Class
 * Set of Arithmetic Computations / Calculations
 */

class Math
{
    /*
     * Precentage to Decimal
     * @param decimal $pct
     * @return decimal
     *
     * ADD. NOTE: if you actually have a % sign in $pct strip it out
     *  $pct = '15%';
     *  $dec = str_replace('%', '', $pct) / 100;
     *
     * Source: stackoverflow.com/questions/2389182/convert-percent-value-to-decimal-value-in-php
     */
    public static function perToDec($pct)
    {
        return $pct / 100;
    }

    /*
     * Reversing perToDec
     */
    public static function decToPer($dec)
    {
        return $dec * 100;
    }

    /**
     * Calculate age in years based on timestamp and reference timestamp
     *
     * @param int $starttime
     * @param int $endtime
     * @return int
     *
     * Source: shanelabs.com/blog/2008/03/26/calculating-age-from-unix-timestamps-in-php/
     */
    public static function computeAge($starttime, $endtime = 0)
    {
        if ($endtime = 0) {
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
     * Source: stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
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