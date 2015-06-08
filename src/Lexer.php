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
            
            // If current char is whitespace, stop capture if capturing
            if (preg_match(Token::$T[0], $char)) {
                if ($this->state === 1) {
                    $this->flushBuffer();
                    $this->state = 0;
                }
                
                continue;
            }
            
            // If current char is a number, begin or continue capture
            if (preg_match(Token::$T[3], $char)) {
                if ($this->state === 0) {
                    $this->state = 1;
                }
                
                $this->token = Token::T_NUMBER;
                $this->buffer .= $char;
            }
            
            // If current char is an operator, stop capture if capturing and capture operator
            // If current char is a # capture until newline and ignore
        }
        
        // Capture last just in case
        if ($this->state === 1) {
            $this->flushBuffer();   
        }
        
        return $this;
    }
    
    public function flushBuffer()
    {
        print "Flushing buffer: " . $this->token . ' - ' . $this->buffer . "\n";
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
}
