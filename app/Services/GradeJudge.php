<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 24.05.15
 * Time: 23:26
 */

namespace App\Services;


class GradeJudge {

    const VERY_BAD = 0;
    const BAD = 1;
    const GOOD = 2;
    const VERY_GOOD = 3;

    public function isSufficient($grade) {
        $classified = $this->classify($grade);
        return $classified == self::GOOD || $classified == self::VERY_GOOD;
    }

    /**
     * Classifies a grade, by returning one of the following constants:
     * - GradeJudge::VERY_GOOD
     * - GradeJudge::GOOD
     * - GradeJudge::BAD
     * - GradeJudge::VERY_BAD
     *
     * @param $grade the grade that should get classified
     *
     * @return integer
     */
    public function classify($grade) {
        if ($grade <= 6 && $grade > 5) {
            return self::VERY_GOOD;
        } else if ($grade <= 5 && $grade >= 4) {
            return self::GOOD;
        } else if ($grade < 4 && $grade > 3) {
            return self::BAD;
        } else if ($grade <= 3 && $grade >= 1) {
            return self::VERY_BAD;
        } else {
            throw new \InvalidArgumentException("The grade must be between 1 and 6, but was '$grade'");
        }
    }
}