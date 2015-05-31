<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 27.05.15
 * Time: 22:34
 */

namespace App\Gradebook\Helpers;


class Helper {

    /**
     * Calculates the average of all numbers containing in a array
     *
     * @param $array the array containing the values that should be used to calculate average
     */
    public static function avgOfArrayItems($array) {
        return array_sum($array) / count($array);
    }
}