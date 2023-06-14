<?php

require_once SOURCE_DIR. '/models/site/purchasesService.php';

$bag['data'] = ShowHistoric();
$bag['view'] = 'views/site/historic';
return $bag;