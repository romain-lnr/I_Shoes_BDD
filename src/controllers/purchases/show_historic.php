<?php

require_once SOURCE_DIR. '/models/site/purchasesService.php';

$bag['data'] = ['purchases' => ShowHistoric()];
$bag['view'] = 'views/site/historic';
return $bag;