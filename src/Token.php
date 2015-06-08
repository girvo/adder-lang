<?php
namespace Adder;

class Token
{
    const
        T_WHITESPACE = 0,
        T_ADD = 1,
        T_SUBTRACT = 2,
        T_NUMBER = 3,
        T_TERM = 4,
        T_COMMENT = 5;
        
    static
        $T = [
            0 => '/[\s]/',
            1 => '/[+]/',
            2 => '/[-]/',
            3 => '/[\d]+/',
            4 => '/[;]/',
            5 => '/[#].*\n/'
        ];
}
