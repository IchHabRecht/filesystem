<?php
namespace IchHabRecht\Filesystem\Tests;

use IchHabRecht\Filesystem\Fileidentity;
use org\bovigo\vfs\vfsStream;

class FileidentityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function canBeValidatedReturnsTrueForKnownExtensionDataProvider()
    {
        return [
            'mp3' => [
                'vfs://root/foo.mp3',
            ],
            'tar.gz' => [
                'vfs://root/foo.tar.gz',
            ],
            'wmv' => [
                'vfs://root/foo.bar.wmv',
            ],
        ];
    }

    /**
     * @param string $filepath
     * @dataProvider canBeValidatedReturnsTrueForKnownExtensionDataProvider
     */
    public function testCanBeValidatedReturnsTrueForKnownExtension($filepath)
    {
        vfsStream::setup('root');
        touch($filepath);

        $fileidentity = new Fileidentity();

        $this->assertTrue($fileidentity->canBeValidated($filepath));
    }

    /**
     * @return array
     */
    public function canBeValidatedReturnsFalseForUnknownExtensionDataProvider()
    {
        return [
            'baz' => [
                'vfs://root/foo.baz',
            ],
            'mp3.baz' => [
                'vfs://root/foo.mp3.baz',
            ],
        ];
    }

    /**
     * @param string $filepath
     * @dataProvider canBeValidatedReturnsFalseForUnknownExtensionDataProvider
     */
    public function testCanBeValidatedReturnsFalseForUnknownExtensionDataProvider($filepath)
    {
        vfsStream::setup('root');
        touch($filepath);

        $fileidentity = new Fileidentity();

        $this->assertFalse($fileidentity->canBeValidated($filepath));
    }

    /**
     * @return array
     */
    public function getFileExtensionReturnsExpectedExtensionDataProvider()
    {
        return [
            'tar.gz' => [
                'foo.bar.tar.gz',
                'gz',
            ],
            'mp3' => [
                'foo.mp3',
                'mp3',
            ],
            'null byte' => [
                'foo.php' . chr(0) . 'bar.jpg',
                'php',
            ],
        ];
    }

    /**
     * @param string $filepath
     * @param string $expected
     * @dataProvider getFileExtensionReturnsExpectedExtensionDataProvider
     */
    public function testGetFileExtensionReturnsExpectedExtension($filepath, $expected)
    {
        $fileidentity = new Fileidentity();

        $this->assertSame($expected, $fileidentity->getFileExtension($filepath));
    }

    /**
     * @return array
     */
    public function isValidReturnsTrueForValidFilesDataProvider()
    {
        return [
            'jpg' => [
                'vfs://root/foo.jpg',
                'FFD8FFDB',
            ],
            'jpeg' => [
                'vfs://root/foo.jpeg',
                'FFD8FFE0FF004A4649460001',
            ],

        ];
    }

    /**
     * @param string $filepath
     * @param string $filecontent
     * @dataProvider isValidReturnsTrueForValidFilesDataProvider
     */
    public function testIsValidReturnsTrueForValidFiles($filepath, $filecontent)
    {
        vfsStream::setup('root');
        file_put_contents($filepath, hex2bin($filecontent));

        $fileidentitiy = new Fileidentity();

        $this->assertTrue($fileidentitiy->isValid($filepath));
    }

    /**
     * @return array
     */
    public function isValidReturnsFalseForInvalidFilesDataProvider()
    {
        return [
            'psd' => [
                'vfs://root/foo.psd',
                '3842F053',
            ],
            'wav' => [
                'vfs://root/foo.wav',
                '52494647FF00AABB57415645',
            ],

        ];
    }

    /**
     * @param string $filepath
     * @param string $filecontent
     * @dataProvider isValidReturnsFalseForInvalidFilesDataProvider
     */
    public function testIsValidReturnsFalseForInvalidFiles($filepath, $filecontent)
    {
        vfsStream::setup('root');
        file_put_contents($filepath, hex2bin($filecontent));

        $fileidentitiy = new Fileidentity();

        $this->assertFalse($fileidentitiy->isValid($filepath));
    }
}