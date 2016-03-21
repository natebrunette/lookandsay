Look and say
============

A PHP command to run iterations of the [Look and Say][lookandsay] algorithm

Installation
------------

- Checkout the repo
- composer install


[lookandsay]: https://en.wikipedia.org/wiki/Look-and-say_sequence

Running the Application
-----------------------

Run the game by running bin/lookandsay

### Options

- `--no-debug`: Disables debug output.
- `--no-string`: Disables the final string output.  This is useful if you only care about the debugging information.
- `--starting=1`: Define the number to start with.  Defaults to 132.
- `--iterations=10`: Define the number of iterations to run.  Defaults to 50.
