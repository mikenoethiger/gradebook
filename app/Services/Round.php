<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14.05.15
 * Time: 11:06
 */

namespace App\Services;


class Round {

    public function round($value, $fraction) {
        switch ($fraction) {
            case "half":
                return half($value);
            case "quarter":
                return quarter($value);
            case "tenth":
                return tenth($value);
            default:
                return $value;
        }
    }

    /**
     * Rounds a value to 1/2 precision
     * 5.24 -> 5 | 5.25 -> 5.5
     *
     * @param $value the value that should get rounded
     * @return float the rounded value
     */
    public function half($value) {
        return round($value/0.5)*0.5;
    }

    /**
     * Rounds a value to 1/4 precision
     * 5.12 -> 5 | 5.13 -> 5.25
     *
     * @param $value the value that should get rounded
     * @return float the rounded value
     */
    public function quarter($value) {
        return round($value/0.25)*0.25;
    }

    /**
     * Rounds a value to 1/10 precision
     * 5.84 -> 5.8 | 5.85 -> 5.9
     *
     * @param $value the value that should get rounded
     * @return float the rounded value
     */
    public function tenth($value) {
        return round($value/0.1)*0.1;
    }
}