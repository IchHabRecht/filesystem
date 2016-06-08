<?php
namespace IchHabRecht\Filesystem;

class Filemode
{
    /**
     * @param string $directoryPath
     * @param array $settings
     */
    public function setPermissions($directoryPath, array $settings)
    {
        $filePermissions = !empty($settings['file'])
            ? $settings['file']
            : 0;
        $filePermissions = is_array($filePermissions) ? array_filter($filePermissions) : $filePermissions;
        $folderPermissions = !empty($settings['folder'])
            ? $settings['folder']
            : 0;
        $folderPermissions = is_array($folderPermissions) ? array_filter($folderPermissions) : $folderPermissions;

        if (empty($filePermissions) && empty($folderPermissions)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directoryPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        $iterator->rewind();
        foreach ($iterator as $object) {
            if (!empty($filePermissions) && $object->isFile()) {
                $this->ensureFileOrFolderPermissions($object->getPathname(), $filePermissions);
            } elseif (!empty($folderPermissions) && $object->isDir()) {
                $this->ensureFileOrFolderPermissions($object->getPathname(), $folderPermissions);
            }
        }
    }

    /**
     * @param string $fileOrFolderPath
     * @param string|array $permissions
     */
    public function ensureFileOrFolderPermissions($fileOrFolderPath, $permissions)
    {
        if (!is_array($permissions)) {
            chmod($fileOrFolderPath, octdec($permissions));
        } else {
            $fileOrFolderPermissions = fileperms($fileOrFolderPath);
            $fileOrFolderPermissionArray = array_combine(
                ['user', 'group', 'others'],
                array_pad(str_split(decoct($fileOrFolderPermissions & 0777)), 3, 0)
            );
            foreach ($permissions as $key => $value) {
                if (($fileOrFolderPermissionArray[$key] & $value) !== $value) {
                    $fileOrFolderPermissionArray[$key] |= $value;
                }
            }
            $newFileOrFolderPermissions = octdec(implode('', $fileOrFolderPermissionArray));
            if (($fileOrFolderPermissions & $newFileOrFolderPermissions) !== $newFileOrFolderPermissions) {
                chmod($fileOrFolderPath, $newFileOrFolderPermissions);
            }
        }
    }
}
