<?php
function startTimer()
{
    Timer::$starttime = microtime(true);
}

function endTimer()
{
    Timer::$endtime = microtime(true);

    return Timer::$endtime - Timer::$starttime;
}

function toBoolean($boolean)
{
    return $boolean === 'true' ||
        $boolean === '1' ||
        $boolean === 1 ||
        $boolean === true;
}

function extract_credentials($request)
{
    $credentials = $request->only(['email', 'password']);

    $credentials['username'] = $credentials['email'];

    return $credentials;
}

function make_deep_path($nameHash, $length = 4)
{
    $deepPath = '';

    for ($i = 1; $i <= $length; $i++) {
        $deepPath =
            $deepPath . substr($nameHash, $i - 1, 1) . DIRECTORY_SEPARATOR;
    }

    return $deepPath;
}

class Timer
{
    public static $starttime;
    public static $endtime;
}

function is_super_admin()
{
    return Auth::user()->email === 'afaria@alerj.rj.gov.br';
}
