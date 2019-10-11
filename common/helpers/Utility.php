<?php
namespace nad\common\helpers;

class Utility
{
    public static function IsNullOrEmpty($prop){
        return (!isset($prop) || (is_string($prop) && trim($prop) === '') || empty($prop));
    }

    // e.g. convert 25 to بیست و پنج
    public static function convertNumberToPersianWords($input) {
        $words = [
            [
                "",
                "یک",
                "دو",
                "سه",
                "چهار",
                "پنج",
                "شش",
                "هفت",
                "هشت",
                "نه"
            ],
            [
                "ده",
                "یازده",
                "دوازده",
                "سیزده",
                "چهارده",
                "پانزده",
                "شانزده",
                "هفده",
                "هجده",
                "نوزده",
                "بیست"
            ],
            [
                "",
                "",
                "بیست",
                "سی",
                "چهل",
                "پنجاه",
                "شصت",
                "هفتاد",
                "هشتاد",
                "نود"
            ],
            [
                "",
                "یکصد",
                "دویست",
                "سیصد",
                "چهارصد",
                "پانصد",
                "ششصد",
                "هفتصد",
                "هشتصد",
                "نهصد"
            ],
            [
                '',
                " هزار ",
                " میلیون ",
                " میلیارد ",
                " بیلیون ",
                " بیلیارد ",
                " تریلیون ",
                " تریلیارد ",
                " کوآدریلیون ",
                " کادریلیارد ",
                " کوینتیلیون ",
                " کوانتینیارد ",
                " سکستیلیون ",
                " سکستیلیارد ",
                " سپتیلیون ",
                " سپتیلیارد ",
                " اکتیلیون ",
                " اکتیلیارد ",
                " نانیلیون ",
                " نانیلیارد ",
                " دسیلیون "
            ]
        ];
        $splitter = " و ";
        $zero = "صفر";
        if ($input == 0) {
            return $zero;
        }
        if (strlen($input) > 66) {
            return "خارج از محدوده";
        }
        //Split to sections
        $splittedNumber = self::prepareNumber($input);
        $result = [];
        $splitLength = count($splittedNumber);
        for ($i = 0; $i < $splitLength; $i++) {
            $sectionTitle = $words[4][$splitLength - ($i + 1)];
            $converted    = self::threeNumbersToLetter($splittedNumber[$i], $splitter, $words);
            if ($converted !== "") {
                array_push($result, $converted . $sectionTitle);
            }
        }
        return join($splitter, $result);
    }
    public static function prepareNumber($num) {
        if (gettype($num) == "integer" || gettype($num) == "double") {
            $num = (string) $num;
        }
        $length = strlen($num) % 3;
        if ($length == 1) {
            $num = "00" . $num;
        } else if ($length == 2) {
            $num = "0" . $num;
        }
        return str_split($num, 3);
    }
    public static function threeNumbersToLetter($num, $splitter, $words) {
        if ((int) preg_replace('/\D/', '', $num) == 0) {
            return "";
        }
        $parsedInt = (int) preg_replace('/\D/', '', $num);
        if ($parsedInt < 10) {
            return $words[0][$parsedInt];
        }
        if ($parsedInt <= 20) {
            return $words[1][$parsedInt - 10];
        }
        if ($parsedInt < 100) {
            $one = $parsedInt % 10;
            $ten = ($parsedInt - $one) / 10;
            if ($one > 0) {
                return $words[2][$ten] . $splitter . $words[0][$one];
            }
            return $words[2][$ten];
        }
        $one        = $parsedInt % 10;
        $hundreds   = ($parsedInt - $parsedInt % 100) / 100;
        $ten        = ($parsedInt - (($hundreds * 100) + $one)) / 10;
        $out        = [$words[3][$hundreds]];
        $secondPart = (( $ten * 10 ) + $one);
        if ($secondPart > 0) {
            if ($secondPart < 10) {
                array_push($out, $words[0][$secondPart]);
            } else if ($secondPart <= 20) {
                array_push($out, $words[1][$secondPart - 10]);
            } else {
                array_push($out, $words[2][$ten]);
                if ($one > 0) {
                    array_push($out, $words[0][$one]);
                }
            }
        }
        return join($splitter, $out);
    }
}
