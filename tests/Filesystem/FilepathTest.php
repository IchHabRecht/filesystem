<?php
namespace IchHabRecht\Filesystem\Tests;

use IchHabRecht\Filesystem\Filepath;

class FilepathTest extends \PHPUnit_Framework_TestCase
{
    public function testConcatenateThrowsExceptionIfNoArgumentIsGiven()
    {
        $this->setExpectedException(\RuntimeException::class, '', 1465426729);

        $filepath = new Filepath();
        $filepath->concatenate();
    }

    /**
     * @return array
     */
    public function concatenateThrowsExceptionForInvalidArgumentsDataProvider()
    {
        return [
            'null' => [
                [
                    '/var/',
                    null,
                    'www',
                ],
            ],
            'array' => [
                [
                    '/var/',
                    [
                        'www',
                        'vhosts',
                    ],
                ],
            ],
            'object' => [
                [
                    new \stdClass(),
                    '/var',
                    'www',
                ],
            ],
        ];
    }

    /**
     * @param array $paths
     * @dataProvider concatenateThrowsExceptionForInvalidArgumentsDataProvider
     */
    public function testConcatenateThrowsExceptionForInvalidArguments(array $paths)
    {
        $this->setExpectedException(\InvalidArgumentException::class, '', 1465426779);

        $filepath = new Filepath();
        call_user_func_array([$filepath, 'concatenate'], $paths);
    }

    /**
     * @return array
     */
    public function concatenateReturnsConcatenatedPathDataProvider()
    {
        return [
            'absolute unix path' => [
                [
                    '/var',
                    '/www/',
                    '/vhosts/',
                ],
                '/',
                false,
                '/var/www/vhosts',
            ],
            'absolute windows path' => [
                [
                    'C:\\',
                    '\\Users\\',
                    '\\All Users\\',
                    'Favorites',
                ],
                '\\',
                false,
                'C:\\Users\\All Users\\Favorites',
            ],
            'mixed path' => [
                [
                    'C:\\',
                    '/Users/',
                    '\\All Users\\',
                    'Favorites/',
                ],
                '/',
                true,
                'C:/Users/All Users/Favorites',
            ],
        ];
    }

    /**
     * @param string|array $paths
     * @param string $directorySeparator
     * @param bool $ensureSeparator
     * @param string $expected
     * @dataProvider concatenateReturnsConcatenatedPathDataProvider
     */
    public function testConcatenateReturnsConcatenatedPath($paths, $directorySeparator, $ensureSeparator, $expected)
    {
        $filepath = new Filepath($directorySeparator, $ensureSeparator);

        $this->assertSame($expected, call_user_func_array([$filepath, 'concatenate'], (array)$paths));
    }

    /**
     * @return array
     */
    public function ensureDirectorySeparatorDataProvider()
    {
        return [
            'absolute unix path' => [
                '/var/www/vhosts',
                '/',
                '/var/www/vhosts',
            ],
            'absolute windows path' => [
                'C:\\Users\\All Users\\Favorites',
                '/',
                'C:/Users/All Users/Favorites',
            ],
            'mixed path' => [
                'C:\\Users/All Users\\Favorites',
                '\\',
                'C:\\Users\\All Users\\Favorites',
            ],
        ];
    }

    /**
     * @param string $path
     * @param string $directorySeparator
     * @param $expected
     * @dataProvider ensureDirectorySeparatorDataProvider
     */
    public function testEnsureDirectorySeparator($path, $directorySeparator, $expected)
    {
        $filepath = new Filepath($directorySeparator);

        $this->assertSame($expected, $filepath->ensureDirectorySeparator($path));
    }

    /**
     * @return array
     */
    public function normalizeReturnsExpectedPathDataProvider()
    {
        return [
            'unix path' => [
                '/var/www/vhosts/../test/',
                '/',
                '/var/www/test/',
            ],
            'windows path' => [
                'C:\\Users\\.\\.\\All Users\\..\\..\\Favorites',
                '\\',
                'C:\Favorites',
            ],
            'relative path' => [
                '../../var/www/././vhosts/../test/././../',
                '/',
                'var/www/',
            ],
            'complex path' => [
                '/var/.////./www/./././..//vhosts/.//../////../././.././test/////',
                '/',
                '/test/',
            ],
        ];
    }

    /**
     * @param string $path
     * @param string $directorySeparator
     * @param string $expected
     * @dataProvider normalizeReturnsExpectedPathDataProvider
     */
    public function testNormalizeReturnsExpectedPath($path, $directorySeparator, $expected)
    {
        $filepath = new Filepath($directorySeparator);

        $this->assertSame($expected, $filepath->normalize($path));
    }
}