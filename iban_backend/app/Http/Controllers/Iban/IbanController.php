<?php

namespace App\Http\Controllers\Iban;

use App\Http\Controllers\Controller;
use App\Services\Contracts\IbanServiceInterface;
use Illuminate\Http\Request;

class IbanController extends Controller
{
    private IbanServiceInterface $ibanService;

    public function __construct(IbanServiceInterface $ibanService)
    {
        $this->ibanService = $ibanService;
    }

    public function index(Request $request)
    {
        $params = $request->only(['per_page', 'search_text']);
        $ibans = $this->ibanService->getAll($params);

        return response()->json($ibans);
    }
}
