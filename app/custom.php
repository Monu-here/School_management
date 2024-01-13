<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function getSetting()
{
    return DB::table('settings')->first();
}
function getUserSetting()
{
    return Auth::user();
}
function getAgo($timestamp)
{
    $carbonDate = Carbon::parse($timestamp);
    return $carbonDate->diffForHumans();
}
function getPaymentRecord()
{
    return DB::table('payment_records')->first();
}
// function getStatus()
// {
//     return DB::table('payment_records')->first();
// }
// @php
