# Contributte Doctrine MongoDB

[MongoDB](https://github.com/mongodb/mongo-php-library) integration for Nette Framework.

## Content

- [Setup](#setup)
- [Configuration](#configuration)
- [Examples](#examples)

## Setup

Install package

```bash
composer require contributte/doctrine-mongodb
```

Register extension

```neon
extensions:
    mongodb: Nettrine\MongoDB\DI\MongoDBExtension
```

## Configuration

You can look at configuration options here: https://www.php.net/manual/en/mongodb-driver-manager.construct.php

**Schema definition**

```neon
mongodb:
    uri: <string>
    uriOptions: <array>
    driverOptions: <array>
```

**Under the hood**

Default URI is: `mongodb://127.0.0.1/`

**Side notes**

1. At this time we support only 1 connection, the **default** connection. If you need more connections (more databases?), please open an issue or send a PR. Thanks.

## Other

This repository is inspired by these packages:

- https://gitlab.com/nettrine/dbal

Thank you guys.

## Examples

- https://github.com/contributte/playground (playground)
- https://contributte.org/examples.html (more examples)
