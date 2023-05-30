<?php

namespace frontend\services;

use frontend\models\metrics\DiscussionStat;

class DataService
{
    /**
     * Проверка даты.
     * Одна итерация - одна неделя.
     *
     * @param $date
     * @return bool
     */
    public function checkDateWeek($date): bool
    {
        $date = date("Y-m-d", strtotime($date));
        $date = strtotime("monday this week $date") + 60 * 60 * 3;

        for($i = 1;$i < 7;$i++) {
            $discussionGet = DiscussionStat::findOne([
                'date' => $date
            ]);
            if (!empty($discussionGet->date)) {
                $result = false;
            } else {
                $result = true;
            }
            $date =  strtotime('+1 day', $date);
        }
        return $result;
    }
}