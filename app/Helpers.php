<?php

use Carbon\Carbon;

if (!function_exists('parsingAlert')) {
    function parsingAlert($message)
    {
        $string = '';
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $string .= ucfirst($value) . '<br>';
            }
        } else {
            $string = ucfirst($message);
        }
        return $string;
    }
}


if (!function_exists('explodeImplode')) {
    function explodeImplode($str, $symbol_explode = '-', $symbol_implode = ' ')
    {
        $explode = explode($symbol_explode, $str);
        $implode = implode($symbol_implode, $explode);

        return $implode;
    }
}


if (!function_exists('cutText')) {
    function cutText(String $string, $limit = 10)
    {
        $retval = $string;
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array) <= $limit) {
            $retval = $string;
        } else {
            array_splice($array, $limit);
            $retval = implode(" ", $array) . " ...";
        }
        return $retval;
    }
}

if (!function_exists('imageExists')) {
    function imageExists($path)
    {

        if (file_exists($path)) {
            $path = asset($path);
        } else {
            $path = 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg';
        }

        return $path;
    }
}

if (!function_exists('baseDateFormat')) {
    function baseDateFormat(
        $date,
        $format_date = 'j F Y'
    )
    {
        $result = Carbon::parse($date)->format($format_date);
        return $result;
    }
}

if (!function_exists('baseCurrencyFormat')) {
    function baseCurrencyFormat(
        $number,
        $format = 'Rp.'
    )
    {
        $result = $format.' '.number_format(round($number, 2));
        return $result;
    }
}

if (!function_exists('renderErrorViewValidator')) {
    function renderErrorViewValidator(
        String $name
    )
    {
        $html = '';
        if (session('validator')[$name] ?? null){

            $html = '<br><div class="invalid-feedback" style="display: inline;">';
                 foreach(session('validator')[$name] as $item){
                     $html .= $item.' <br>';
                 }
            $html .= '</div>';
        }

        return $html;
    }
}


if (!function_exists('slugCustom')) {
    function slugCustom($name)
    {
        $slug = preg_replace('~[^\pL\d]+~u', '-', $name);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug); // transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
        $slug = strtolower($slug); // lowercase

        return $slug;
    }
}
