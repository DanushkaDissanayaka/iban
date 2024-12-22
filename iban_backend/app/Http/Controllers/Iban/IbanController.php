<?php

namespace App\Http\Controllers\Iban;

use App\Http\Controllers\Controller;
use App\Http\Requests\IbanValidationRequest;
use App\Services\Contracts\IbanServiceInterface;
use App\Helper\Validation\IbanValidationHelper;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
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

    public function ibanValidate(IbanValidationRequest $request)
    {
        $iban = $request->get('iban');
        // IBAN is validate from Iban validation request store in database
        $data = [
            'number' => $iban,
            'user_id' => auth()->user()->id
        ];

        $this->ibanService->create($data);
        
        return response()->json([
            'result' => trans('validation-message.valid_iban',['iban' => $iban])
        ]);
    }
}
