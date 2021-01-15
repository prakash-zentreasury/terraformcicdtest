<?php
namespace App\Http\Controllers\Helpers;
use Carbon\Carbon;

function checkbox($value)
{
    if($value)
        return "checked";
    return "unchecked";
}

function getLargeCheckBox($value)
{
    if($value)
        return "fa fa-check fa-10x text-primary";

    return "fa fa-remove fa-5x text-danger";
}

function date_difference_days_years($startDate, $endDate)
{
    $end = Carbon ::parse($endDate);
    $start = Carbon ::parse($startDate);
    $length = $end -> diffInDays($start);
    return $length / 365;
}

function date_difference_days($startDate, $endDate)
{
    date_default_timezone_set('UTC');
    $dateDiff = strtotime($endDate) - strtotime($startDate);
    $daysBetween = floor($dateDiff / (60 * 60 * 24));
    return $daysBetween;
}

function one_day_later($date)
{
    return Carbon ::parse($date) -> addDay();
}

function one_day_before($date)
{
    return Carbon ::parse($date) -> subDay();
}

function number_to_month($monthNum)
{
    $dateObj = DateTime ::createFromFormat('!m', $monthNum);
    return $dateObj -> format('F');
}

function getPreviousBusinessDay($date)
{
    return \Carbon\Carbon ::parse($date) -> previousWeekday() -> toDateString();

}

function getCountryFromCurrency($currencyId)
{
    $country = \App\Zen\Setting\Model\Country ::where('currency_id', $currencyId) -> first();
    return $country -> name;
}

function mYFormat($number, $decimalAfter = 2)
{
    return number_format($number, $decimalAfter);
}

function mYAccountFormat($number)
{
    return number_format($number, config('account.format.decimal_place'), config('account.format.decimal_separator'), config('account.format.thousand_separator'));
}

function formatDate($date, $format = 'd.m.Y')
{
    return Carbon ::parse($date) -> format($format);
}

function getCurrencyInLoanDashboard($currency)
{
    return ' <img title="' . $currency -> iso_4217_code . '" src="/vendor/famfamfam/png/' . $currency -> iso_3166_code . '.png">';
}

function addADay($givenDate)
{
    return \Carbon\Carbon ::parse($givenDate) -> addDay() -> toDateString();
}

function mkDate($givenDate)
{
    return \Carbon\Carbon ::parse($givenDate) -> toDateString();
}

function rnd($number, $format = 2)
{
    return round($number, $format);
}

function accountRound($number)
{
    return round($number, config('account.format.decimal_place'));
}

function checkDateEarlierSameMonth($date1, $date2)
{
    if(Carbon ::parse($date1) -> format('Y-m') == Carbon ::parse($date2) -> format('Y-m')) {
        if(Carbon ::parse($date1) < Carbon ::parse($date2))
            return false;
    }
    return true;
}
