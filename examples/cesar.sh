#!/bin/bash

function index() {
  x="${1%%$2*}"
  [[ "$x" = "$1" ]] && echo -1 || echo "${#x}"
}

# args: input, offset, charset
function cipher() {
    set_length=${#3}
    str=""
    for (( i=0; i<${#1}; i++ )); do
        c="${1:$i:1}"
        j=$(index "$3" "$c")
        str="$str${3:$(((j + $2 + set_length)%set_length)):1}"
    done
    echo $str
}