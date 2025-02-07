<?php

use App\Conversions\CastJson;

test('cast array to json', function () {
    $array = ['name' => 'John', 'age' => 30];
    $jsonConversion = CastJson::convert($array);

    $this->assertInstanceOf(\Illuminate\Database\Query\Expression::class, $jsonConversion);
    $grammar = new \Illuminate\Database\Query\Grammars\Grammar;

    $expectedJson = addslashes(json_encode($array));
    $expectedSql = "CAST('{$expectedJson}' AS JSON)";
    $this->assertEquals($expectedSql, $jsonConversion->getValue($grammar));
});

test('cast null to json', function () {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage('A valid JSON string was not provided.');

    $json = null;

    CastJson::convert($json);
});
