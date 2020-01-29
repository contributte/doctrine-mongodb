# Nettrine MongoDB

[MongoDB](https://github.com/mongodb/mongo-php-library) to Nette Framework.


## Content
- [Setup](#setup)
- [Configuration](#configuration)
- [Examples](#examples)


## Setup

Install package

```bash
composer require nettrine/mongodb
```

Register extension

```yaml
extensions:
  nettrine.mongodb: Nettrine\MongoDB\DI\MongoDBExtension
```

## Configuration

You can look at configuration options here: https://www.php.net/manual/en/mongodb-driver-manager.construct.php

**Schema definition**

 ```yaml
nettrine.mongodb:
  uri: <string>
  uriOptions: <array>
  driverOptions: <array>
```

**Under the hood**

Default URI is: mongodb://127.0.0.1

**Side notes**

1. At this time we support only 1 connection, the **default** connection. If you need more connections (more databases?), please open an issue or send a PR. Thanks.


## Other

This repository is inspired by this package.

- https://gitlab.com/nettrine/dbal

Thank you guys.


## Examples

You can find more examples in [planette playground](https://github.com/planette/playground) repository.
