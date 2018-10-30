<?php
/**
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

require_once __DIR__ . "/../includes/Utils.php";

?>
<!DOCTYPE html>
<html lang="<?php echo Utils::getLang() ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo Utils::getString("demo_title") ?></title>
    <link type="text/css" rel="stylesheet" href="/dist/vendor/css/vendor.min.css">
    <link type="text/css" rel="stylesheet" href="/dist/css/demo.min.css">
    <link type="text/css" rel="stylesheet" href="/dist/css/highlight/monokai.css">
    <script src="/dist/vendor/js/vendor.js"></script>
    <script src="/dist/js/demo.min.js"></script>
</head>
<body>

<div class="container mt-3">
    <div class="row">
        <div class="col text-center">
            <h3><?php echo Utils::getString("demo_title_long") ?></h3>
            <p><?php echo Utils::getString("demo_authors") ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-6">
            <div class="form-group text-center">
                <label for="code-input"><?php echo Utils::getString("demo_form_input") ?></label>
                <textarea id="code-input" class="form-control" rows="8"><?php echo "lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua"?></textarea>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group text-center">
                <label for="code-output"><?php echo Utils::getString("demo_form_output") ?></label>
                <textarea id="code-output" class="form-control" rows="8"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h5><?php echo Utils::getString("demo_options") ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col col-6 col-lg-3">
            <label for="code-offset"><?php echo Utils::getString("demo_form_offset") ?></label>
            <input id="code-offset" class="form-control" type="number" min="0"
                   value="<?php try {
                       echo random_int(1, 10);
                   }
                   catch(Exception $e) {
                       echo 1;
                   } ?>">
        </div>
        <div class="col col-6 col-lg-9">
            <label for="code-charset"><?php echo Utils::getString("demo_form_charset") ?></label>
            <input id="code-charset" class="form-control" type="text" value="abcdefghijklmnopqrstuvwxyz">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col text-center">
            <h5><?php echo Utils::getString("demo_source_code") ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <pre>
                <code class="lang-javascript"><?php
                    $file = file_get_contents(__DIR__ . "/../src/js/_casar.js");
                    $no_copyright = preg_replace("/^\/\*[\s\S]*?\*\/\s+/m", "", $file, 1);
                    $no_jsdoc = preg_replace("/^\/\*\*[\s\S]*?\*\/\s+/m", "", $no_copyright);
                    echo $no_jsdoc;
                    ?></code>
            </pre>
        </div>
    </div>
</div>

</body>
</html>