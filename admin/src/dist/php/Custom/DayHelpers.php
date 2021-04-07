<?php
namespace helpers;
use DateTime;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\SendingTimesEntity;

final class DayHelper {

    static protected $arrayOfDays = [
        'Saturday' => 'شنبه',
        'Sunday' => 'یک شنبه',
        'Monday' => 'دو شنبه',
        'Tuesday' => 'سه شنبه',
        'Wednesday' => 'چهار شنبه',
        'Thursday' => 'پنج شنبه',
        'Friday' => 'جمعه'
    ];
    public static function toOption(bool $selected = true) {
        $output = [];
        foreach (self::toArray() as $key => $item){
            $output[] = HtmlTags::Option()->Value($key)->Content($item);
            if ($selected) end($output)->Selected();
        }
        return implode('',$output);
    }

    public static function toArray() {
        return self::$arrayOfDays;
    }

    public static function today() {
        return date('l');
    }
    public static function dayAfter($day = null) {
        if ($day == null){
            $day = date('l');
        }
        return date('l',strtotime("tomorrow",strtotime($day)));
    }
    
}
