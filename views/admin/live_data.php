<?php
use App\Controllers\MembersController;
use App\Controllers\AttendeesController;
use App\Controllers\AreaController;

require_once '../../vendor/autoload.php';

header('Content-Type: application/json');

// Fetch counts
$data = [
    'totalMembers' => (new MembersController)->countAllMembers(),
    'totalAttendees' => (new AttendeesController)->getAllTheAttendees(),
    'estancia' => (new AreaController)->getEstanciaCount(),
    'balasan' => (new AreaController)->getBalasanCount(),
    'batad' => (new AreaController)->getBatadCount(),
    'carles' => (new AreaController)->getCarlesCount(),
    'sara' => (new AreaController)->getSaraCount(),
    'sanDionisio' => (new AreaController)->getSanDionisioCount(),
    'sanRafael' => (new AreaController)->getSanRafaelCount(),
    'lemery' => (new AreaController)->getLemeryCount(),
    'concepcion' => (new AreaController)->getConcepcionCount(),
    'gigantes' => (new AreaController)->getGigantesCount(),
    'ajuy' => (new AreaController )->getAjuyCount(),
    'banate' => ( new AreaController )->getBanateCount(),
    'barotacViejo' => ( new AreaController )->getBarotacViejoCount(),
    'anilao' => ( new AreaController )->getAnilaoCount(),
];

echo json_encode($data);
