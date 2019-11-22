<?php

function error($file, $line, $text) {
    echo "::error file=$file,line=$line,col=0::$text\n";
}

echo "We are doing somehting\n";
error('.gitignore', 38, 'Testing warninigs');
echo "And still doing someting\n";
error('.gitignore', 41, 'Testing warninigs 2');
echo "Else\n";
