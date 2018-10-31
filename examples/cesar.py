import re

def cipher(inpt, offset, charset):
    str = ""
    for c in inpt:
        if re.match(r".*\s.*", c):
            str += c
            continue
        j = charset.index(c)
        str += charset[(j + offset + len(charset)) % len(charset)]
    return str


