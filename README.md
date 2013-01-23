# Introduction #

This is a PHP API for interfacing with the network

# Installation #

The easiest way to install is to use [Composer](http://getcomposer.org). You can reference it in your project like this:

    {
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/FuturePublishing/php-network"
            }
        ],
        "require": {
            "FuturePublishing/php-network": ">=1.0.0"
        }
    }

It conforms to the [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) standard so can be autoloaded easily. (If you use Composer, including its `autoloader.php` will do all the work for you.)

## Requirements ##

* PHP 5.3+
* PHPUnit 3.6+ (for running unit tests)

# Usage #

## \Future\Network\Connection\SocketConnection ##

The `SocketConnection` class allows you to send data (it does not receive data) over a TCP or UDP connection. Example:

```php
<?php
use \Future\Network\Connection\SocketConnection;

try {
    //                             host         port     protocol
    $socket = new SocketConnection('localhost', '11211', SocketConnection::TYPE_TCP);
    $socket->send("set / 0 3600 5 noreply\r\nhello\r\n");
} catch (\Future\Network\Exception $e) {
    die($e->getMessage());
}
```

The constructor will throw an exception if it fails to connect, meaning the class won't be instantiated. In this case you may want to instantiate a DummyConnection in its place if you need an object but you don't really care if it doesn't work.

## \Future\Network\Connection\DummyConnection ##

The DummyConnection class implements the \Future\Network\Connection interface in the most minimal way possible. It is useful if you need to test with, or if a SocketConnection fails and you need something to pass to another class.
