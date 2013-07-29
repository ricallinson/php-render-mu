<?php
namespace php_require\php_render_mu;

require(__DIR__. "/mu/src/mustache/Autoloader.php");
\Mustache_Autoloader::register();

$m = new \Mustache_Engine();

$module->exports = function ($filename, $data, $callback) use ($m) {

    ob_start();
    // extract($data);

    if (isset($data["start"])) {
        $data["end"] = (microtime(true) - $data["start"]) / 1000;
    }

    $buffer = $m->render(file_get_contents($filename), $data);
    ob_end_clean();
    $callback(null, $buffer);
};
