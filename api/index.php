<?php

/**
 * Vercel Serverless Function Entry Point for Laravel
 */

// Handle Vercel HTTPS and proxy headers
if ((isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') || (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']))) {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

// Muat index utama Laravel dari folder public
require __DIR__ . '/../public/index.php';
