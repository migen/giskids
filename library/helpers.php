<?php


function csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function old($key, $default = '')
{
    return $_SESSION['old'][$key] ?? $default;
}

function flash($key, $value = null)
{
    if ($value === null) {
        return $_SESSION['flash'][$key] ?? null;
    }
    $_SESSION['flash'][$key] = $value;
}

function redirect($url)
{
    header("Location: {$url}");
    exit;
}


function pr(...$vars)
{
    echo '<pre>';
    foreach ($vars as $var) {
        print_r($var);
    }
    echo '</pre>';
}


function prx($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	exit;
}

function require_file(string $path): void
{
    require_once BASE_PATH . '/' . ltrim($path, '/');
}

function debug($q, $subject = NULL)
{
	if (isset($_GET['debug']) && isset($_SESSION['srid']) && $_SESSION['srid'] == RMIS) {
		if (!is_null($subject)) {
			pr($subject);
		}
		pr($q);
	}
}
