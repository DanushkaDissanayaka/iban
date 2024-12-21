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
        $per_page = $request->query('per_page');
        $ibans = $this->ibanService->getAll($per_page);

        return response()->json([$ibans]);
    }
}
