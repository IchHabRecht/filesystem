<?php
namespace IchHabRecht\Filesystem\Tests;

use IchHabRecht\Filesystem\Filemode;
use org\bovigo\vfs\vfsStream;

class FilemodeTest extends \PHPUnit_Framework_TestCase
{
    public function testSetPermissions()
    {
        vfsStream::setup('root');
        $directoryPath = vfsStream::url('root');
        mkdir($directoryPath . DIRECTORY_SEPARATOR . 'bar');
        touch($directoryPath . DIRECTORY_SEPARATOR . 'bar' . DIRECTORY_SEPARATOR . 'baz');

        $settings = [
            'file' => '555',
            'folder' => '777',
        ];

        /** @var Filemode|\PHPUnit_Framework_MockObject_MockObject $filemodeMock */
        $filemodeMock = $this->getMock(Filemode::class, ['ensureFileOrFolderPermissions']);
        $filemodeMock->expects($this->at(0))
            ->method('ensureFileOrFolderPermissions')
            ->with($directoryPath, '777');
        $filemodeMock->expects($this->at(1))
            ->method('ensureFileOrFolderPermissions')
            ->with($directoryPath . DIRECTORY_SEPARATOR . 'bar', '777');
        $filemodeMock->expects($this->at(2))
            ->method('ensureFileOrFolderPermissions')
            ->with($directoryPath . DIRECTORY_SEPARATOR . 'bar' . DIRECTORY_SEPARATOR . 'baz', '555');

        $filemodeMock->setPermissions($directoryPath, $settings);
    }

    /**
     * @return array
     */
    public function ensureFileOrFolderPermissionsDataProvider()
    {
        return [
            'Permissions are set' => [
                '555',
                '777',
                '777',
            ],
            'Permissions are ensured' => [
                '555',
                [
                    'user' => 6,
                    'group' => 6,
                    'others' => 0,
                ],
                '775',
            ],
        ];
    }

    /**
     * @param string $defaultPermissions
     * @param string|array $permissions
     * @param string $expectedPermissions
     * @dataProvider ensureFileOrFolderPermissionsDataProvider
     */
    public function testEnsureFileOrFolderPermissions($defaultPermissions, $permissions, $expectedPermissions)
    {
        vfsStream::setup('root');

        $filePath = vfsStream::url('root/foo');
        touch($filePath);
        chmod($filePath, octdec($defaultPermissions));

        $filemode = new Filemode();
        $filemode->ensureFileOrFolderPermissions($filePath, $permissions);

        $this->assertSame($expectedPermissions, decoct(fileperms($filePath) & 0777));
    }

}