<?php
namespace Adder;

class Adder
{
    private $filename;
    private $scanner;
    private $lexer;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->scanner = new Scanner($filename);
    }
    
    public function run()
    {
        $this->lexer = new Lexer($this->scanner);
        
        $this->lexer->tokenise();
        
        exit(0);
    }
}
