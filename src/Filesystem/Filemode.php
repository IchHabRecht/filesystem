<?php
namespace IchHabRecht\Filesystem;

class Filemode
{
    /**
     * @param string $directoryPath
     * @param array $settings
     */
    public function setUmask($directoryPath, array $settings)
    {
        $fileUmask = !empty($settings['file'])
            ? $settings['file']
            : 0;
        $fileUmask = is_array($fileUmask) ? array_filter($fileUmask) : $fileUmask;
        $folderUmask = !empty($settings['folder'])
            ? $settings['folder']
            : 0;
        $folderUmask = is_array($folderUmask) ? array_filter($folderUmask) : $folderUmask;

        if (empty($fileUmask) && empty($folderUmask)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directoryPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        $iterator->rewind();
        foreach ($iterator as $object) {
            if (!empty($fileUmask) && $object->isFile()) {
                $this->ensureFileOrFolderPermissions($object->getPathname(), $fileUmask);
            } elseif (!empty($folderUmask) && $object->isDir()) {
                $this->ensureFileOrFolderPermissions($object->getPathname(), $folderUmask);
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
