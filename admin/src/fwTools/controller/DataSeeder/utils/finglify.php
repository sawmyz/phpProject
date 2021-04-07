<?php
class Finglify {

    /** @var array */
    private $rules;

    public function __construct()
    {
        $this->rules[0] = array(
            'ای' => 'i',
            'او' => 'oo',
        );

        $this->rules[1] = array(
            // Numeric characters
            '۱' => 1,
            '۲' => 2,
            '۳' => 3,
            '۴' => 4,
            '۵' => 5,
            '۶' => 6,
            '۷' => 7,
            '۸' => 8,
            '۹' => 9,
            '۰' => 0,

            /* Persian */
            'آ' => 'aa',
            'ا' => 'a',
            'ب' => 'b',
            'پ' => 'p',
            'ت' => 't',
            'ث' => 's',
            'ج' => 'j',
            'چ' => 'ch',
            'ح' => 'h',
            'خ' => 'kh',
            'د' => 'd',
            'ذ' => 'z',
            'ر' => 'r',
            'ز' => 'z',
            'س' => 's',
            'ش' => 'sh',
            'ص' => 's',
            'ض' => 'z',
            'ط' => 't',
            'ظ' => 'z',
            'ع' => 'aa',
            'غ' => 'gh',
            'ف' => 'f',
            'ق' => 'gh',
            'ك' => 'k',
            'ک' => 'k',
            'گ' => 'g',
            'ل' => 'l',
            'م' => 'm',
            'ن' => 'n',
            'و' => 'v',
            'ه' => 'h',
            'ي' => 'y',
            'ی' => 'y',
        );
    }

    public function translate($string)
    {

        foreach ($this->rules as $rule)
        {
            $string = strtr($string, $rule);
        }

        return $string;
    }
}