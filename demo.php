<?php
/*
 * Written by siben.vn
 */
require_once __DIR__ . '/src/SiBenJS.php';

echo '<script type="text/javascript">' . (new SiBenJs())->render('alert("Hello World!")') . '</script>';