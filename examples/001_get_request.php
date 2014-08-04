<?php

require __DIR__ . '/../vendor/autoload.php';

try {
    // Instantiate the HTTP client
    $client = new Artax\Client;

    // Make an asynchronous HTTP request
    $promise = $client->request('http://httpbin.org/user-agent');

    // Client::request() is asynchronous! It doesn't return a response. Instead, it
    // returns a promise to resolve the response at some point in the future when
    // it's finished. Here we tell the promise that we want to wait for it to complete.
    $response = $promise->wait();

    // Output the results
    printf(
        "\nHTTP/%s %d %s\n",
        $response->getProtocol(),
        $response->getStatus(),
        $response->getReason()
    );

} catch (Artax\ClientException $error) {
    // If something goes wrong the Promise::wait() call will throw the relevant
    // exception. The Client::request() method itself will never throw.
    echo $error;
}
