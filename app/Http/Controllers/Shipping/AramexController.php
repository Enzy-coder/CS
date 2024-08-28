<?php
namespace App\Http\Controllers\Shipping;

use App\Http\Services\Shipping\AramexService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AramexController extends Controller
{
    protected $aramexService;

    public function __construct(AramexService $aramexService)
    {
        $this->aramexService = $aramexService;
    }

    public function getRates()
    {
        $results = $this->aramexService->getRates();

        return response()->json($results);
    }
}