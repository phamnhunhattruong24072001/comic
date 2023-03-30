<?php
if (!function_exists('formatDate')) {
    function formatDate($date, $location)
    {
        if ($location == config('const.system.language.vi')){
            $dateFormat = date('d/m/Y', strtotime($date));
        }else{
            $dateFormat = $date;
        }
        return $dateFormat;
    }
}
