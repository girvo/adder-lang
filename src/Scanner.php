<?php
namespace Adder;

class Scanner
{
    private $file;
    private $length;
    private $curr;
    private $prev;
    
    public function __construct($filename)
    {
        $this->file = file_get_contents($filename);
        $this->length = strlen($this->file);
        $this->curr = 0;
        $this->prev = -1;
    }
    
    public function scan()
    {
        $char = substr($this->file, $this->curr, 1);
        
        // This is when we get to the end of the string
        if ($char === false) {
            return false;
        }
        
        $this->prev = $this->curr;
        $this->curr = $this->curr + 1;
        
        return $char;
    }

    public function getLength()
    {
        return $this->length;
    }
}
