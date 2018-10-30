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

#include <stdio.h>
#include <stdint.h>
#include <input.h>

uint16_t index(uint8_t *input, uint8_t c)
{
    for(int16_t i = 0; i < strlen(input); i++)
    {
        if(input[i] == c) {
            return i;
        }
    }
}

void cypher(uint8_t *ptr, uint8_t *input,
            int16_t offset, uint8_t *charset)
{
    uint16_t set_length = strlen(charset);
    for(int16_t i = 0; i < strlen(input); i++)
    {
        if(input[i] == 0x20) {
            ptr[i] = 0x20;
            continue;
        }
        uint16_t j = index(charset, input[i]);
        ptr[i] = charset[(j + offset + set_length) % set_length];
    }
    ptr[strlen(input)] = 0;
}