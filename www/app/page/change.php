<?php

site()->layoutInit();
site()->addPageTitle("Change Log");
$theme = "ssc-a"; // page theme

echo site()->changes($theme);
echo site()->layout();
