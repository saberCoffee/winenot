<?php
namespace W\WineNotClasses;

class Form
{

    public function isValid($inputValue = '', $min = '', $max = '')
    {
        $error = '';
        if (empty($inputValue)) {
            $error = 'Vous devez remplir ce champ.';
        } else {
            if (!empty($min) OR !empty($max)) {
                if (strlen($inputValue) != $min && $min == $max) {
                    $error = 'Vous devez utiliser <strong>' . $min . '</strong> caractères.';
                } elseif (strlen($inputValue) < $min) {
                    $error = 'Vous devez utiliser au moins <strong>' . $min . '</strong> caractères.';
                } elseif (strlen($inputValue) > $max) {
                    $error = 'Vous ne pouvez pas utiliser plus de <strong>' . $max . '</strong> caractères.';
                }
            }
        }
        return $error;
    }
    
}
