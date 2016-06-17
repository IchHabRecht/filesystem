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

### Fileidentity

```php
$fileidentity = new \IchHabRecht\Filesystem\Fileidentity();
if (!$fileidentity->canBeValidated('/path/to/file') || $fileidentity->isValid('/path/to/file')) {
    // Do something
}
```

#### canBeValidated

Check if the extension of a file has a registered signature in Fileidentity class and so its content can be validated.

#### isValid

Test the first bytes of a file to be valid according to its known signature. If the file does not exist or is not
readable an error is thrown. You can use canBeValidated() to ensure the file can be validated.

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

### Filepath

```php
$filepath = new \IchHabRecht\Filesystem\Filepath('/', true);
$filepath->concatenate('/var/', 'www', 'vhosts'); // Returns '/var/www/vhosts'
$filepath->ensureDirectorySeparator('C:\\Users\\All Users\\Favorites'); // Returns 'C:/Users/All Users/Favorites'
$filepath->normalize('/var/www/./../../vhosts'); // Returns '/vhosts'
```

#### Initialization

If you initialize a new object, you can specify the `directory separator` used for further processing as well as declare
if this separator `should be enforced` for given paths. Directory separator can be either slash or backslash.

#### Concatenate

You can pass any number of `string` arguments to this function. All arguments are concatenated with the specified directory
separator. Trailing slashes are removed.

#### EnsureDirectorySeparator

All directory separators (`/` and `\`) are converted into the specified one.

#### Normalize

The functions removes doubled (or multiple) directory separators and resolves path traversals.
