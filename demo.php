<?php
/*
 * Written by siben.vn
 */
require_once __DIR__ . '/src/SiBenJS.php';

echo (new SiBenJs())->render('alert("Hello World!")');