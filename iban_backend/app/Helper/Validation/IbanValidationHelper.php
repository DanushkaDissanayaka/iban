<?php

namespace App\Helper\Validation;
use stdClass;
class IbanValidationHelper
{

    public static function validateIBAN($iban)
    {
        /**
         * GB12ABCD10203012345678
         * IBAN format {GB - country code} {12 - check digit} {ABCD - bank code} {102030 - short code} {12345678 - UK Account number}
         */
        
        $result = new stdClass();
        $result->success = true;
        $result->message = trans('validation-message.valid_iban');

        if (!preg_match('/^[A-Z0-9]+$/', $iban)) {
            // Contains invalid characters
            $result->message = trans('validation-message.iban_contains_invalid_characters');
            $result->success = false;
            return $result;
        }

        // Get length
        $ibanLength = strlen($iban);
        $ibanLengths = config('iban.country_specific_lengths');

        // get country code
        $countryCode = substr($iban, 0, 2);

        if (!isset($ibanLengths[$countryCode]) || $ibanLength !== $ibanLengths[$countryCode]) {
            $result->message = trans('validation-message.invalid_iban_country_code');
            $result->success = false;
        }

        if (isset($ibanLengths[$countryCode]) && $ibanLength !== $ibanLengths[$countryCode]) {
            // invalid iban length
            $result->message = trans('validation-message.invalid_iban_length');
            $result->success = false;
        }

        if ($result->success === false) {
            return $result;
        }

        // Perform the MOD 97-10 check
        $ibanReordered = substr($iban, 4) . substr($iban, 0, 4); // Rearrange the IBAN
        $ibanNumeric = '';

        /**
         * Convert letters to numbers according to IBAN
         * Alphabet to numbers translation table
         * (A=10, B=11, ..., Z=35)
         **/
        for ($i = 0; $i < strlen($ibanReordered); $i++) {
            $char = $ibanReordered[$i];

            // if not numeric get ascii value and subtract 55 EX A = 65 -> 65-55 = 10
            $ibanNumeric .= is_numeric($char) ? $char : ord($char) - 55;
        }
        /**
         * Perform the MOD 97 check,
         * If the modulo (remainder after the integer division) is 1,
         * then the initial account number is a
         * correct ΙΒΑΝ format; else this is not an IBAN account number.
         */

        if ((int)bcmod($ibanNumeric, 97) === 1) {
            // Valid IBAN
            return $result;
        } else {
            $result->success = false;
            $result->message = trans('validation-message.invalid_iban');
            return $result;
        }
    }
}
