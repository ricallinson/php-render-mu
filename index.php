<?php
namespace php_require\php_render_mu;

require(__DIR__. "/mu/src/mustache/Autoloader.php");
\Mustache_Autoloader::register();

$m = new \Mustache_Engine();

$module->exports = function ($filename, $data=array(), $callback=null) use ($m) {

    ob_start();
    if (isset($data["start"])) {
        $data["end"] = round(microtime(true) - $data["start"]);
    }

    $buffer = $m->render(file_get_contents($filename), $data);
    ob_end_clean();
    
    if ($callback) {
        $callback(null, $buffer);
    }

    return $buffer;
};
