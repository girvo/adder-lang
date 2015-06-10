<?php
namespace Adder;

class Adder
{
    private $filename;
    private $scanner;
    private $lexer;
    private $parser;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->scanner = new Scanner($filename);
    }
    
    public function run()
    {
        $this->lexer = new Lexer($this->scanner);
        $this->parser = new Parser($this->lexer);
        
        print $this->parser->parse();
        
        exit(0);
    }
}
