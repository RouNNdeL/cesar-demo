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

import {cipher, CHARSET} from "../src/js/_cesar";
import assert from 'assert';

describe("Cesar", function() {
    describe("#cipher", function() {
        it("Should return itself when offset is 0", function() {
            for(let i = 0; i < 10; i++) {
                const input = generateRandom(16, CHARSET);
                assert.equal(cipher(input, 0), input);
            }
        });

        it("Should return itself when offset is equal to charset length", function() {
            for(let i = 0; i < 10; i++) {
                const input = generateRandom(16, CHARSET);
                assert.equal(cipher(input, CHARSET.length), input);
            }
        });

        it("Should return itself when offset is equal to negative charset length", function() {
            for(let i = 0; i < 10; i++) {
                const input = generateRandom(16, CHARSET);
                assert.equal(cipher(input, -CHARSET.length), input);
            }
        });

        it("Should return previously checked values", function() {
            const test = ["thisisatest", "we are testing"];
            const offset = [7, 14];
            const correct = ["aopzpzhalza", "ks ofs hsghwbu"];

            for(let i = 0; i < test.length; i++) {
                assert.equal(cipher(test[i], offset[i]), correct[i]);
            }
        });

        it("Should work with custom charsets", function() {
            const test = ["thisisatest123", "We Are Testing"];
            const charset = ["abcdefghijklmnopqrstuvwxyz123456789", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"];
            const offset = [12, 17];
            const correct = ["6tu5u5m6q56def", "nv RIv kvJKzEx"];

            for(let i = 0; i < test.length; i++) {
                assert.equal(cipher(test[i], offset[i], charset[i]), correct[i]);
            }
        });
    });
});

function generateRandom(length = 16, charset = "abcdefghijklmnopqrstuvwxyz") {
    let text = "";
    charset += "\s\t";

    for (let i = 0; i < length; i++)
        text += charset.charAt(Math.floor(Math.random() * charset.length));

    return text;
}