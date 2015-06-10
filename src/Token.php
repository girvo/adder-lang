<?php
namespace Adder;

class Token
{
    const
        T_WHITESPACE = 'T_WHITESPACE',
        T_NUMBER = 'T_NUMBER',
        T_SEMI = 'T_SEMI',
        T_COMMENT = 'T_COMMENT',
        T_NEWLINE = 'T_NEWLINE',
        T_OPERATOR = 'T_OPERATOR';
        
    static
        $match = [
            Token::T_WHITESPACE => '/[\s]/',
            Token::T_NUMBER => '/[\d]+/',
            Token::T_SEMI => '/[;]/',
            Token::T_COMMENT => '/[#]/',
            Token::T_OPERATOR => '/[\+\-\*\/]/',
            Token::T_NEWLINE => '/[\n]/'
        ];
}
