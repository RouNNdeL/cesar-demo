<?php

function cipher(string $input, int $offset, string $charset) {
    $str = "";
    for($i = 0; $i < strlen($input); $i++) {
        if(preg_match("/\s/", $input, $matches)) {
            $str .= $input[$i];
            continue;
        }
        $j = strpos($charset, $input[$i]);
        $str .= $charset[
            ($j + $offset + strlen($charset)) % strlen($charset)
        ];
    }
    return $str;
}