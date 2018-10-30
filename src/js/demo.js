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

import hljs from 'highlight.js';
import $ from 'jquery';
import {cipher1} from "./_casar";

hljs.initHighlightingOnLoad();

$(function() {
    const offset = 3;
    const charset = "abcdefghijklmnopqrstuvwxyz";

    const input = $("#code-input");
    const output = $("#code-output");
    input.on("input", function() {
        $(this).val($(this).val().replace(new RegExp(`[^${charset}]`, "g"), ""));
        output.val(cipher1($(this).val(), offset, charset));
    });
    output.on("input", function() {
        $(this).val($(this).val().replace(new RegExp(`[^${charset}]`, "g"), ""));
        input.val(cipher1($(this).val(), -offset));
    });
});