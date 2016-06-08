# filesystem

Library for advanced filesystem functions.

[![Latest Stable Version](https://img.shields.io/packagist/v/ichhabrecht/filesystem.svg)](https://packagist.org/packages/ichhabrecht/filesystem)
[![Build Status](https://img.shields.io/travis/IchHabRecht/filesystem/master.svg)](https://travis-ci.org/IchHabRecht/filesystem)

## Installation

It's recommended that you use [Composer](https://getcomposer.org/) to include filesystem in your project.

```bash
$ composer require ichhabrecht/filesystem
```

## Usage

### Filemode

```php
$filemode = new \IchHabRecht\Filesystem\Filemode();
$filemode->setPermissions('/path/to/adjust', $settings);
```

#### Settings

The settings parameter is an array with either a key named `file` or `folder` or both.

You can enforce a hard setting of permissions by using a string value or ensure different permissions by
defining them in an array.

```php
// This sets file permissions to read and execute (5) and folder permissions to read, write and execute (7)
$settings = [
    'file' => '555',
    'folder' => '777',
];

// This ensures read and write access (6) for files, as well as write and execute access (3) for folders
$settings = [
    'file' => [
        'user' => 6,
        'group' => 6,
        'other' => 6,
    ],
    'folder' => [
        'user' => 3,
        'group' => 3,
        'other' => 3,
    ],
];
```

You can use different permissions for the `user`, `group` and `other` values or just specify the ones you want to ensure.
