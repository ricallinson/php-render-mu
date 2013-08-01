<?php

$module = new stdClass();

/*
    Now we "require()" the file to test.
*/

require(__DIR__ . "/../index.php");

$render = $module->exports;

/*
    Now we test it.
*/

describe("php-render-php", function () use ($render) {

    describe("render", function () use ($render) {

        it("should return [true]", function () use ($render) {
            assert(gettype($render) === "object" && get_class($render) === "Closure");
        });

        it("should return [empty string]", function () use ($render) {
            $result = $render("./test/fixtures/empty.mu.html");
            assert($result === "");
        });

        it("should return [bar]", function () use ($render) {
            $result = $render("./test/fixtures/foo.mu.html", array("foo"=>"bar"));
            assert($result === "bar");
        });

        it("should return [baz]", function () use ($render) {
            $render("./test/fixtures/foo.mu.html", array("foo"=>"baz"), function ($err, $str) {
                assert($str === "baz");
            });
        });

        it("should return [microtime]", function () use ($render) {
            $result = $render("./test/fixtures/empty.mu.html", array("start"=>microtime(true)));
            assert($result == floatval($result));
        });
    });
});
