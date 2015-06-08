# "Adder" -- A Tiny Interpreter in PHP
This is a tiny interpreter for a pointless language, written in PHP (solely because I'm being lazy and can't be bothered firing up a different IDE). I (@girvo) am building this to wrap my head around lexers, parsers and compilers -- fundamentals in computer science that I'm lacking in currently. Please don't judge my code too harshly!

## Language
````
2 + 3 * 5;
1 + 2;

// Output:
//   17
//   3
````

As you can see, there's not much to it. It's enough that I can get an idea of how things slot together when building a lexer and parser, and no more. The interpreter takes a filename as input on the commandline, reads the file in, scans the contents one character at a time and hands the result off to the lexer. The lexer builds a set of tokens, which are then handed on to the parser, which builds an abstract syntax tree, which is then handed on (phew!) to the "runtime" (which as it stands is pretty simple and stupid);

## Future
- [ ] Add results of each line to one another
- [ ] Implement variables
- [ ] Add comments into our tiny language
- [ ] Add function calls rather than just expressions