<?php

/**
 * Simple AuthSystem stub
 * This is a placeholder for the auth system that was referenced
 */
class AuthSystem
{
    public static function init()
    {
        // Initialize session if needed
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function check()
    {
        return isset($_SESSION['user_id']);
    }
    
    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }
}