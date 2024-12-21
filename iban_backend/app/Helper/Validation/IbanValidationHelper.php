<?php

namespace Helper\Validation;

class IBANValidationHelper
{

    static function validateIBAN($iban)
    {
        // Remove any spaces or hyphens from the IBAN
        $iban = strtoupper(preg_replace('/[^A-Z0-9]/', '', $iban));

        // Check length and format (for example, UK IBAN length should be 22 characters)
        $ibanLength = strlen($iban);

        // Country-specific IBAN lengths and formats
        $ibanLengths = [
            'AL' => 28,
            'AD' => 24,
            'AT' => 20,
            'AZ' => 28,
            'BH' => 22,
            'BE' => 16,
            'BA' => 20,
            'BR' => 29,
            'BG' => 22,
            'HR' => 21,
            'CY' => 28,
            'CZ' => 24,
            'DK' => 18,
            'DO' => 28,
            'EE' => 20,
            'FO' => 18,
            'FI' => 18,
            'FR' => 27,
            'DE' => 22,
            'GI' => 23,
            'GR' => 27,
            'GL' => 18,
            'GT' => 28,
            'HU' => 28,
            'IS' => 26,
            'IE' => 22,
            'IL' => 23,
            'IT' => 27,
            'KZ' => 20,
            'KW' => 30,
            'LV' => 21,
            'LB' => 28,
            'LI' => 21,
            'LT' => 20,
            'LU' => 20,
            'MK' => 19,
            'MT' => 31,
            'MR' => 27,
            'MU' => 30,
            'MD' => 24,
            'MC' => 27,
            'ME' => 22,
            'NL' => 20,
            'NO' => 15,
            'PK' => 24,
            'PL' => 28,
            'PT' => 25,
            'QA' => 29,
            'RO' => 24,
            'RU' => 22,
            'SM' => 27,
            'SA' => 24,
            'RS' => 22,
            'SK' => 24,
            'SI' => 19,
            'ES' => 24,
            'SE' => 24,
            'CH' => 21,
            'TR' => 26,
            'UA' => 29,
            'GB' => 22,
            'VG' => 24
        ];

        // Check if the IBAN is the correct length based on the country
        $countryCode = substr($iban, 0, 2);
        if (!isset($ibanLengths[$countryCode]) || $ibanLength !== $ibanLengths[$countryCode]) {
            return false; // Invalid length for this country
        }

        // Check if the IBAN contains only alphanumeric characters
        if (!preg_match('/^[A-Z0-9]+$/', $iban)) {
            return false; // Contains invalid characters
        }

        // Perform the MOD 97-10 check
        $ibanReordered = substr($iban, 4) . substr($iban, 0, 4); // Rearrange the IBAN
        $ibanNumeric = '';

        // Convert letters to numbers (A=10, B=11, ..., Z=35)
        for ($i = 0; $i < strlen($ibanReordered); $i++) {
            $char = $ibanReordered[$i];
            $ibanNumeric .= is_numeric($char) ? $char : ord($char) - 55;
        }

        // Perform the MOD 97 check
        if (bcmod($ibanNumeric, 97) === 1) {
            return true; // Valid IBAN
        }

        return false; // Invalid IBAN
    }
}
