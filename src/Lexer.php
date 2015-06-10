<?php
namespace Adder;

class Lexer
{
    private $scanner;
    private $tokens;
    private $token;
    private $buffer;
    private $state;
    
    public function __construct(Scanner $scanner)
    {
        $this->scanner = $scanner;
        $this->tokens = [];
        $this->state = 0;
        $this->buffer = '';
        $this->token = null;
    }
    
    public function tokenise()
    {
        for ($i = 0; $i <= $this->scanner->getLength(); $i++) {
            $char = $this->scanner->scan();
            
            if ($this->state === 3) {
                if (preg_match(Token::$match[Token::T_NEWLINE], $char)) {
                    $this->state = 0;
                }
                
                continue;
            }
            
            // If current char is a # capture until newline and ignore
            if (preg_match(Token::$match[Token::T_COMMENT], $char)) {
                if ($this->state === 1) {
                    $this->flushBuffer();
                    $this->state = 0;
                }
                                
                $this->state = 3;
                continue;
            }
            
            // If current char is whitespace, stop capture if capturing
            if (preg_match(Token::$match[Token::T_WHITESPACE], $char)) {
                if ($this->state === 1) {
                    $this->flushBuffer();
                    $this->state = 0;
                }
                
                continue;
            }
            
            // If current char is a number, begin or continue capture
            if (preg_match(Token::$match[Token::T_NUMBER], $char)) {
                if ($this->state === 0) {
                    $this->token = Token::T_NUMBER;
                    $this->state = 1;
                }
                
                $this->buffer .= $char;
                
                continue;
            }
            
            // If current char is an operator, stop capture if capturing and capture operator
            if (preg_match(Token::$match[Token::T_OPERATOR], $char)) {
                if ($this->state === 1) {
                    $this->flushBuffer();
                    $this->state = 0;
                }
                
                $this->buffer .= $char;
                $this->token = Token::T_OPERATOR;
                $this->flushBuffer();
                
                continue;
            }
            
            // If we're on the last character, flush the buffer
            if ($i === $this->scanner->getLength() && $this->state === 1) {
                $this->flushBuffer();
                
                continue;
            }
        }
        
        return $this;
    }
    
    public function flushBuffer()
    {
        $this->storeToken(
            $this->token,
            $this->buffer
        );
        
        $this->token = null;
        $this->buffer = '';
    }
    
    public function storeToken($token, $value, $charNo = 0, $lineNo = 0)
    {
        $this->tokens[] = [
            'token'  => $token,
            'value'  => $value,
            'charNo' => $charNo,
            'lineNo' => $lineNo
        ];
        
        return $this;
    }
    
    public function getTokens()
    {
        return $this->tokens;
    }
}
