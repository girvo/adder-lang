<?php
namespace Adder;

class Parser
{
    private $tokens;
    private $ast;
    
    public function __construct(Lexer $lexer)
    {
        $this->ast = [];
        $this->tokens = $lexer->tokenise()->getTokens();
    }
    
    public function parse()
    {
        $result = 0;
        $operator = '';
        $previousToken = '';
        
        foreach ($this->tokens as $k => $token) {
            if ($k === 0) {
                if ($token['token'] === Token::T_NUMBER) {
                    $result = $token['value'];
                    $previousToken = $token['token'];
                } else {
                    throw new SyntaxError('First token must be a number');
                }
                
                continue;
            }
            
            if ($token['token'] === Token::T_OPERATOR) {
                if ($previousToken !== Token::T_NUMBER) {
                    throw new SyntaxError('Operators must follow a number');
                }
                
                $operator = $token['value'];
                $previousToken = Token::T_OPERATOR;
                continue;
            }
            
            if ($token['token'] === Token::T_NUMBER) {
                if ($previousToken !== Token::T_OPERATOR) {
                    throw new SyntaxError('Numbers must follow an operator');
                }
                
                switch ($operator) {
                    case '+':
                        $result = $result + $token['value'];
                        break;
                    case '-':
                        $result = $result - $token['value'];
                        break;
                    case '*':
                        $result = $result * $token['value'];
                        break;
                    case '/':
                        $result = $result / $token['value'];
                        break;
                    default:
                        break;
                }
                
                $previousToken = Token::T_NUMBER;
                $operator = '';
                continue;
            }
            
            throw new SyntaxError('Invalid token');
        }
        
        return "Result: " . $result . "\n";
    }
}

class SyntaxError extends \Exception
{
}