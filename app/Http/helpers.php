<?php

use Carbon\Carbon;

if (! function_exists('minutes_from_seconds')) {
    /**
     * Converts seconds to minutes (i:s).
     *
     * @param  int  $seconds
     * @return string
     */
    function minutes_from_seconds(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds - ($hours * 3600) - ($minutes * 60);

        $allMinutes = $hours * 60 + $minutes;

        return sprintf('%02d:%02d', $allMinutes, $seconds);
    }
}

if (! function_exists('time_from_seconds')) {
    /**
     * Converts seconds to time (H:i:s).
     *
     * @param  int  $seconds
     * @return string
     */
    function time_from_seconds(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds - ($hours * 3600) - ($minutes * 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}

if (! function_exists('time_formatted')) {
    /**
     * Converts time to the format (H:i).
     *
     * @param  string|null  $time
     * @return string
     */
    function time_formatted(?string $time): string
    {
        if ($time === null) {
            return '00:00';
        }

        list($hours, $minutes) = explode(':', $time);

        return sprintf('%02d:%02d', $hours, $minutes);
    }
}

if (! function_exists('date_formatted')) {
    /**
     * Formats a Carbon date.
     *
     * @param  Carbon|null  $date
     * @param  string  $format
     * @return string|null
     */
    function date_formatted(Carbon $date = null, string $format = 'd/m/Y'): ?string
    {
        return $date !== null ? $date->format($format) : null;
    }
}

if (! function_exists('print_converted_bytes')) {
    /**
     * Formats a Carbon date.
     *
     * @param $bytes
     * @param  string|null  $unit
     * @return string
     */
    function print_converted_bytes($bytes, string $unit = null): string
    {
        $size = $bytes;

        $units = ['KB', 'MB', 'GB', 'TB', 'PB'];

        if ($unit !== null) {
            $pos = array_search(strtoupper($unit), $units);

            if ($pos !== false) {
                $currentUnit = strtoupper($unit);

                for ($p = $pos; $p >= 0; $p--) {
                    $size /= 1024;
                }
            }
        } else {
            $currentUnit = null;

            foreach ($units as $unit) {
                $size /= 1024;

                $currentUnit = $unit;

                if (abs($size) < 1024) {
                    break;
                }
            }
        }

        return sprintf('%s %s', round($size, 2), $currentUnit);
    }
}
