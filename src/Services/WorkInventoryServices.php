<?php


namespace App\Services;


use DateTimeInterface;

class WorkInventoryServices
{
    private const DAY_HOURS = 24;

    /**
     * Calculate interval between work_end and work_start and return how many hours is between those.
     * @param DateTimeInterface $workStart - when work started
     * @param DateTimeInterface $workEnd - when work ended
     * @return float - Duration in hours
     */
    public function calculateDuration(DateTimeInterface $workStart, DateTimeInterface $workEnd): float
    {
//        $workStart = new \DateTime("2021-03-05 20:20:00");
//        $workEnd = new \DateTime("2021-03-05 21:20:00");

        $duration = $workEnd->diff($workStart);
        $durationInHours = 0.0;

        /* handle minutes:
         * - for interval 1-30 min plus 0.5 hour
         * - for interval 31-59 min plus 1 hour */
        if ($duration->i <= 30 && $duration->i > 0)
            $durationInHours += 0.5;
        else if ($duration->i < 60 && $duration->i > 30)
            $durationInHours += 1;

        // handle hours
        $durationInHours += $duration->h;

        // handle days
        $durationInHours += $duration->days * self::DAY_HOURS;

//        dump($durationInHours);
//        dd($duration);

        unset($workStart, $workEnd, $duration);
        return $durationInHours;
    }
}