<?php

namespace FacadesL1241;

use Illuminate\Support\Facades\Http;

use function PHPStan\Testing\assertType;

function test(): void
{
    assertType('Illuminate\Http\Client\Response', Http::get('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::post('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::put('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::patch('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::delete('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::head('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::send('GET', 'https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::timeout(30)->get('https://example.test'));
    assertType('Illuminate\Http\Client\Response', Http::withHeaders(['X-Foo' => 'bar'])->post('https://example.test'));

    assertType('Illuminate\Http\Client\Promises\LazyPromise', Http::async()->get('https://example.test'));
    assertType('Illuminate\Http\Client\Promises\LazyPromise', Http::async()->post('https://example.test'));
    assertType('Illuminate\Http\Client\Promises\LazyPromise', Http::async()->send('GET', 'https://example.test'));
    assertType('Illuminate\Http\Client\Promises\LazyPromise', Http::timeout(30)->async()->get('https://example.test'));
    assertType('Illuminate\Http\Client\Promises\LazyPromise', Http::withHeaders(['X-Foo' => 'bar'])->async()->post('https://example.test'));

}
