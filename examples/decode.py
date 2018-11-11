#!/usr/bin/env python3

import argparse
import os.path
import re
import operator
import codecs
from math import sqrt

CHARSETS = {
    "en": {
        "name": "English",
        "charset": "abcdefghijklmnopqrstuvwxyz",
        "frequency": {
            "a": 0.08167, "b": 0.01492, "c": 0.02782, "d": 0.04253, "e": 0.12702, "f": 0.02228, "g": 0.02015,
            "h": 0.06094, "i": 0.06966, "j": 0.00153, "k": 0.00772, "l": 0.04025, "m": 0.02406, "n": 0.06749,
            "o": 0.07507, "p": 0.01929, "q": 0.00095, "r": 0.05987, "s": 0.06327, "t": 0.09056, "u": 0.02758,
            "v": 0.00978, "w": 0.0236, "x": 0.0015, "y": 0.01974, "z": 0.00074
        }
    },
    "pl": {
        "name": "Polish",
        "charset": "aąbcćdeęfghijklłmnńoóprsśtuwyzźż",
        "frequency": {"a": 0.10503, "b": 0.0174, "c": 0.03895, "d": 0.03725, "e": 0.07352, "f": 0.00143, "g": 0.01731,
                      "h": 0.01015, "i": 0.08328, "j": 0.01836, "k": 0.02753, "l": 0.02564, "m": 0.02515, "n": 0.06237,
                      "o": 0.06667, "p": 0.02445, "r": 0.05243, "s": 0.05224, "t": 0.02475, "u": 0.02062, "w": 0.05813,
                      "y": 0.03206, "z": 0.04852, "ą": 0.00699, "ć": 0.00743, "ę": 0.01035, "ł": 0.02109, "ń": 0.00362,
                      "ó": 0.01141, "ś": 0.00814, "ź": 0.00078, "ż": 0.00706, }
    }
}


def is_valid_file(parser, arg):
    if not os.path.exists(arg):
        parser.error("The file %s does not exist!" % arg)
    else:
        return codecs.open(arg, 'r', encoding="utf-8")  # return an open file handle


def parse_args():
    parser = argparse.ArgumentParser(description="Attempts to decode a file encoded using the Cesar's "
                                                 "cipher")
    parser.add_argument("-l", "--lang", dest="language", action="store", default="en",
                        help="expected language of the file [en, pl]")
    parser.add_argument("-o", "--output", dest="output", action="store", metavar="FILE",
                        help="save the most probable option to a file")
    parser.add_argument("file", action="store",
                        help="file to process", type=lambda x: is_valid_file(parser, x))

    a = parser.parse_args()
    if a.language not in CHARSETS:
        parser.error("Invalid language '%s' please choose on of [en, pl]" % a.language)

    return a


def cipher(inpt, offset, chars):
    s = ""
    for c in inpt:
        if re.match(r".*\s.*", c):
            s += c
            continue
        try:
            j = chars.index(c)
        except ValueError:
            s += c
            continue
        s += chars[(j + offset + len(chars)) % len(chars)]
    return s


def char_ratio(inpt):
    count = {}
    for c in inpt:
        if c not in count:
            count[c] = 0
        count[c] += 1

    count.update((x, y / len(inpt)) for x, y in count.items())
    return count


def calculate_error(inpt, expected):
    dev = 0
    n = len(inpt)
    for c in inpt:
        dev += (inpt[c] - expected[c]) ** 2
    s_err = sqrt(dev / (n - 1)) / sqrt(len(inpt))
    return s_err


if __name__ == '__main__':
    args = parse_args()
    charset = CHARSETS[args.language]
    lwr = args.file.read().lower()
    string = re.sub(r"[^" + charset["charset"] + "]", "", lwr, 0, re.MULTILINE)
    errors = {}
    for i in range(len(charset["charset"])):
        ratio = char_ratio(cipher(string, -i, charset["charset"]))
        errors[i] = calculate_error(ratio, charset["frequency"])

    mn = min(errors.items(), key=operator.itemgetter(1))[1]
    mx = max(errors.items(), key=operator.itemgetter(1))[1] - mn

    scale = 1 / mx
    errors.update((x, 1 - (y - mn) * scale) for x, y in errors.items())
    sort = sorted(errors.items(), key=lambda x: x[1], reverse=True)

    print("Analysis complete")
    print("The most probable offset used to encode this text in %s was %d\n" % (charset["name"], sort[0][0]))
    for i in range(min(len(sort), 10)):
        print("%d: %f" % (sort[i][0], sort[i][1]))
    more = len(sort) - 10
    if more > 0:
        print("\nAnd %d more..." % more)

    if "output" in args:
        file = codecs.open(args.output, "w", "utf-8")
        s = cipher(lwr, -sort[0][0], charset["charset"])
        file.write(s)
        file.close()
