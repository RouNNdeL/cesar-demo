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
import {cipher} from "./_cesar";

hljs.initHighlightingOnLoad();

$(function() {
    const offset = $("#code-offset");
    const charset = $("#code-charset");
    const input = $("#code-input");
    const output = $("#code-output");

    let offset_val = offset.val();
    let charset_val = charset.val();

    function refreshOutput() {
        input.val(input.val().replace(new RegExp(`[^${charset_val}\\s]`, "g"), ""));
        output.val(cipher(input.val(), offset_val % charset_val.length, charset_val));
    }

    refreshOutput();

    input.on("input", refreshOutput);

    output.on("input", function() {
        $(this).val($(this).val().replace(new RegExp(`[^${charset_val}\\s]`, "g"), ""));
        input.val(cipher($(this).val(), -offset_val));
    });

    offset.on("input", function() {
        const val = Math.max(parseInt($(this).val().replace(/[^\d]/, "")), 0);
        $(this).val(val);
        if(!isNaN(val)) {
            offset_val = val;
            refreshOutput();
        }
    });

    charset.change(function() {
        charset_val = $(this).val().split("").filter(function(item, i, allItems) {
            return i === allItems.indexOf(item);
        }).join("");
        $(this).val(charset_val);
        refreshOutput();
    });
});