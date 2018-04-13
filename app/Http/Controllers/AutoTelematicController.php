<?php
/**
 * Controller for all the auto telematic routes to the the api.
 *
 * @author: Cuesta
 */

namespace App\Http\Controllers;
use App\AutoTelematic\AutoTelematic;
use Symfony\Component\HttpFoundation\Response;

class AutoTelematicController
{
    public function decode($vin)
    {
        $at = new AutoTelematic();
        return Response::create($at->decode($vin), 200, ['Content-Type' => 'application/json']);
    }
}