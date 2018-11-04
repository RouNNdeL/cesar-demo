/*
 *  MIT License
 *
 *  Copyright (c) 2018 Krzysztof "RouNdeL" Zdulski
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 */

export const CHARSET = "abcdefghijklmnopqrstuvwxyz";

/**
 * An implementation using a simple for loop
 * Note: The function doesn't check whether the provided string only contains chars from the charset
 * Different characters may produce unexpected results
 * @param {string} input
 * @param {Number} offset
 * @param {string} charset
 * @return {string}
 */
export function cipher(input, offset, charset = CHARSET) {
    let str = "";
    for(let i = 0; i < input.length; i++) {
        let c = input.charAt(i);
        if(c.match(/\s/) !== null) {
            str += c;
            continue;
        }
        let j = charset.indexOf(c);
        str += charset.charAt(
            (j + offset + charset.length) % charset.length
        );
    }
    return str;
}