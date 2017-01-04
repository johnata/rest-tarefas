<?php

for ($i = 1; $i <= 100; $i++) {
    if ((($i % 3) == 0) && (($i % 5) == 0)) {
        echo "FizzBuzz - $i<br />";
    } elseif ((($i % 3) == 0)) {
        echo "Fizz - $i<br />";
    } elseif ((($i % 5) == 0)) {
        echo "Buzz - $i<br />";
    } else {
        echo "$i<br />";
    }
}