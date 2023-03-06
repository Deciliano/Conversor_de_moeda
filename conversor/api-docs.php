<?php

$openApi = \OpenApi\scan([app_path(), app_path('Http/Controllers/ProductController.php'), app_path('Http/Controllers/CurrencyController.php')]);
header('Content-Type: application/yaml');
echo $openApi->toYaml();