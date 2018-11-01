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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Utils::getString("demo_title") ?></title>
    <link type="text/css" rel="stylesheet" href="/dist/vendor/css/vendor.min.css">
    <link type="text/css" rel="stylesheet" href="/dist/css/demo.min.css">
    <link type="text/css" rel="stylesheet" href="/dist/css/highlight/monokai.css">
    <script src="/dist/vendor/js/vendor.js"></script>
    <script src="/dist/js/demo.min.js"></script>
</head>
<body>
<?php
if(!isset($_COOKIE["lang"])) {
    $flags = "";
    foreach(Utils::AVAILABLE_LANGUAGES as $i => $lang) {
        $name = Utils::LANGUAGE_NATIVE_NAMES[$i];
        $flags .= <<<HTML
        <div class="col col-auto text-center">
            <img class="flag" src="/$lang.png" data-lang-id="$lang">
            <p class="mb-0">$name</p>
        </div>
HTML;

    }
    echo <<<HTML
<div id="lang-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please select your language</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          $flags
        </div>
      </div>
    </div>
  </div>
</div>
HTML;

}
?>

<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col text-center">
            <h3><?php echo Utils::getString("demo_title_long") ?> </h3>
            <p><?php echo Utils::getString("demo_authors") ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-6 pr-1">
            <div class="form-group text-center">
                <label for="code-input"><?php echo Utils::getString("demo_form_input") ?></label>
                <textarea id="code-input" class="form-control"
                          rows="8"><?php echo "lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua" ?></textarea>
            </div>
        </div>
        <div class="col col-lg-6 pl-1">
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
        <div class="col col-6 col-lg-3 pr-1">
            <label for="code-offset"><?php echo Utils::getString("demo_form_offset") ?></label>
            <input id="code-offset" class="form-control" type="number" min="0"
                   value="<?php try {
                       echo random_int(1, 10);
                   }
                   catch(Exception $e) {
                       echo 1;
                   } ?>">
        </div>
        <div class="col col-6 col-lg-9 pl-1">
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
        <div class="col col-12 col-lg-6 d-flex flex-column mt-3">
            <div class="row">
                <div class="col text-center">
                    <h6>Javascript (ECMAScript 6)</h6>
                </div>
            </div>
            <div class="row flex-grow-1">
                <div class="col d-flex flex-column">
                    <pre class="d-flex flex-grow-1">
                        <code class="source lang-javascript"><?php
                            $file = file_get_contents(__DIR__ . "/../src/js/_cesar.js");
                            $no_copyright = preg_replace("/^\/\*[\s\S]*?\*\/\s+/m", "", $file, 1);
                            $no_jsdoc = preg_replace("/^\/\*\*[\s\S]*?\*\/\s+/m", "", $no_copyright);
                            echo htmlspecialchars($no_jsdoc);
                            ?></code>
                    </pre>
                </div>
            </div>
        </div>
        <?php
        $extensions = ["c", "java", "kt", "py", "php", "sh", "bat"];
        $names = ["C (C11)", "Java (JDK 9)", "Kotlin (1.3)", "Python (2.7)", "PHP (7.0.3)", "Bash (4.4.12)", "Batch/DOS (Windows 7)"];
        $lang = ["cpp", "java", "kotlin", "python", "php", "bash", "dos"];
        foreach($extensions as $i => $extension) {
            $file = file_get_contents(__DIR__ . "/../examples/cesar." . $extension);
            $no_copyright = preg_replace("/^\/\*[\s\S]*?\*\/\s+/m", "", $file, 1);
            $code = htmlspecialchars($no_copyright);

            echo <<<HTML
        <div class="col col-12 col-lg-6 d-flex flex-column mt-3">
            <div class="row">
                <div class="col text-center">
                    <h6>$names[$i]</h6>
                </div>
            </div>
            <div class="row flex-grow-1">
                <div class="col d-flex flex-column">
                    <pre class="d-flex flex-grow-1">
                        <code class="source $lang[$i]">$code</code>
                    </pre>
                </div>
            </div>
        </div>
HTML;

        }
        ?>
    </div>

    <footer class="bg-secondary text-white fixed-bottom">
        <div class="row px-3 py-2">
            <div class="col col-auto">
                <a href="https://github.com/RouNNdeL/cesar-demo"><img src="/github.png" class="social"></a>
            </div>
            <div class="col text-center d-none d-md-block">
                Copyright © 2018 Krzysztof "RouNdeL" Zdulski
            </div>
            <div class="col col-auto ml-auto ml-md-0">
                <div class="row pr-2">
                    <?php
                    foreach(Utils::AVAILABLE_LANGUAGES as $lang) {
                        echo  <<<HTML
                    <div class="col col-auto text-center px-1">
                        <img class="flag footer" src="/$lang.png" data-lang-id="$lang">
                    </div>
HTML;

                    }
                    ?>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>