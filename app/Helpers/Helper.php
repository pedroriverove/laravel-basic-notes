<?php

namespace App\Helpers;

use App\Models\Note;
use Illuminate\Support\Carbon;

class Helper
{
    /**
     * @param string $date
     * @return array|false|string|string[]
     */
    public static function detectDateTimeFormat(string $date)
    {
        // List of all supported separators (add all you need)
        $ds = ['-', '/', ' '];
        // List of all supported formats (add your own if needed)
        $fs = [
            'Y[-]m[-]d H:i:s',
            'Y[-]m[-]d H:i',
            'Y[-]m[-]d',
            'Y[-]m',
            'Y',
            'd[-]m[-]Y H:i:s',
            'd[-]m[-]Y H:i',
            'd[-]m[-]Y',
            'd[-]m',
            'd',
            'm[-]Y H:i:s',
            'm[-]Y H',
            'm[-]Y',
            'm',
            'H:i:s',
            'H:i',
            'H',
        ];

        foreach ($fs as $f) {
            foreach ($ds as $sep) {
                $format = str_replace('[-]', $sep, $f);
                $d = Carbon::createFromFormat($format, $date);
                if ($d && $d->format($format) == $date) {
                    return $format;
                }
            }
        }

        return false;
    }

    /**
     * @param int $state
     * @return string
     */
    public static function convertState(int $state): string
    {
        $value = 'Pendiente';

        if ($state === Note::STATUS_IN_PROGRESS) {
            $value = 'En Proceso';
        } elseif ($state === Note::STATUS_FINISHED) {
            $value = 'Terminado';
        }

        return $value;
    }

    /**
     * @param $date
     * @param $format
     * @return mixed
     */
    public static function customDateFormat($date, $format = 'd F Y H:i')
    {
        if (is_null($date)) {
            return false;
        }

        $f = self::detectDateTimeFormat($date);

        return Carbon::createFromFormat($f, $date)->format($format);
    }
}
