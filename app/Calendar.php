<?php

namespace App;
class Calendar
{
    private $activity;
    function __construct() {
        $this->activities = Activity::all();
    }
    private $html;    
    public function showCalendarTag($m, $y,$path)
    {
        //$activities = [3 => "予定1", 2 => "予定2"];
        
        $year = $y;
        $month = $m;
        if ($year == null) {
            $year = date("Y");
            $month = date("m");
        }
        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year)); 
        $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year));
        $day = 1 - $firstWeekDay;
        
        
        
        $prev = strtotime('-1 month',mktime(0, 0, 0, $month, 1, $year));
        $prev_year = date("Y",$prev);
        $prev_month = date("m",$prev);
        
        $next = strtotime('+1 month',mktime(0, 0, 0, $month, 1, $year));
        $next_year = date("Y",$next);
        $next_month = date("m",$next);
        $this->html = <<< EOS
        
<h1 class="text-center">
    <a class="btn btn-light" href="{$path}/?year={$prev_year}&month={$prev_month}" role="button">&lt;</a>
    {$year}年{$month}月
    <a class="btn btn-light" href="{$path}/?year={$next_year}&month={$next_month}" role="button">&gt;</a>
</h1>
<table class="table table-bordered">
    <tr>
        <th class="text-center text-danger">日</th>
        <th class="text-center">月</th>
        <th class="text-center">火</th>
        <th class="text-center">水</th>
        <th class="text-center">木</th>
        <th class="text-center">金</th>
        <th class="text-center text-primary">土</th>
    </tr>
EOS;
        while ($day <= $lastDay) {
            $this->html .= "<tr>";
            for ($i = 0; $i < 7; $i++) {
                if ($day <= 0 || $day > $lastDay) {
                    $this->html .= "<td>&nbsp;</td>";
                } else {
                    $this->html .= "<td>" . $day . "&nbsp<a href='#'>詳細</a>";
                    $target = date("y-m-d", mktime(0,0,0, $month, $day, $year));
                    foreach($this->activities as $activity) {
                        if ($activity->day == $target) {
                            $this->html .= $activity->title;
                            break;
                        }
                    }
                    $this->html .= "</td>";
                }
               $day++;
            }

            $this->html .= "</tr>";
        }

        return $this->html .= '</table>';
    }
}