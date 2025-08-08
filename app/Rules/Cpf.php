<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Implemente aqui a lógica de validação do CPF (ex: algoritmo de dígitos verificadores)
        // Para exemplo simples, só aceitamos 11 dígitos:
        return preg_match('/^\d{11}$/', $value);
    }

    public function message()
    {
        return 'O :attribute não é um CPF válido.';
    }
}
