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
    <link type="text/css" rel="stylesheet" href="/dist/css/highlight/default.css">
    <script src="/dist/vendor/js/vendor.js"></script>
    <script src="/dist/js/demo.min.js"></script>
</head>
<body>

<div class="container">
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
                <textarea id="code-input" class="form-control" rows="8"></textarea>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group text-center">
                <label for="code-input"><?php echo Utils::getString("demo_form_output") ?></label>
                <textarea id="code-output" class="form-control" rows="8"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <pre class="col"><code><?php
                //TODO: Load code from file
                echo "const example = \"test\"";
                ?></code></pre>
    </div>
</div>

</body>
</html>