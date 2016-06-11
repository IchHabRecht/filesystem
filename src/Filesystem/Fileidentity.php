<?php
namespace IchHabRecht\Filesystem;

class Fileidentity
{
    /**
     * @var array
     */
    private $fileSignatures = [
        '3g2' => [
            0 => '667479703367',
        ],
        '3gp' => [
            0 => '667479703367',
        ],
        '7z' => [
            0 => '377ABCAF271C',
        ],
        '8sv' => [
            0 => '464F524D........38535658',
        ],
        '8svx' => [
            0 => '464F524D........38535658',
        ],
        'acbm' => [
            0 => '464F524D........4143424D',
        ],
        'aif' => [
            0 => '464F524D........41494646',
        ],
        'aifc' => [
            0 => '464F524D........41494646',
        ],
        'aiff' => [
            0 => '464F524D........41494646',
        ],
        'anbm' => [
            0 => '464F524D........414E424D',
        ],
        'anim' => [
            0 => '464F524D........414E494D',
        ],
        'apk' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'asf' => [
            0 => '3026B2758E66CF11A6D900AA0062CE6C',
            1 => '2453444930303031',
        ],
        'avi' => [
            0 => '52494646........41564920',
        ],
        'bac' => [
            0 => '4241434B4D494B454449534B',
        ],
        'bmp' => [
            0 => '424D',
        ],
        'bpg' => [
            0 => '425047FB',
        ],
        'bz2' => [
            0 => '425A68',
        ],
        'cab' => [
            0 => '4D534346',
        ],
        'cin' => [
            0 => '802A5FD7',
        ],
        'class' => [
            0 => 'CAFEBABE',
            1 => 'EFBBBF',
            2 => 'FEEDFACE',
            3 => 'FEEDFACF',
            4 => 'CEFAEDFE',
            5 => 'CFFAEDFE',
            6 => 'FFFE',
            7 => 'FFFE0000',
        ],
        'cmus' => [
            0 => '464F524D........434D5553',
        ],
        'cr2' => [
            0 => '49492A00100000004352',
        ],
        'crx' => [
            0 => '43723234',
        ],
        'cwk' => [
            0 => '05070000424F424F0507000000000000000000000001',
            1 => '0607E100424F424F0607E10000000000000000000001',
        ],
        'dat' => [
            0 => '504D4F43434D4F43',
        ],
        'dba' => [
            0 => 'BEBAFECA',
            1 => '00014244',
        ],
        'dex' => [
            0 => '6465780A30333500',
        ],
        'dib' => [
            0 => '424D',
        ],
        'djv' => [
            0 => '41542654464F524D........444A56',
        ],
        'djvu' => [
            0 => '41542654464F524D........444A56',
        ],
        'dmg' => [
            0 => '7801730D626260',
        ],
        'doc' => [
            0 => 'D0CF11E0A1B11AE1',
        ],
        'docx' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'dpx' => [
            0 => '53445058',
            1 => '58504453',
        ],
        'exe' => [
            0 => '4D5A',
        ],
        'exr' => [
            0 => '762F3101',
        ],
        'fax' => [
            0 => '464F524D........46415858',
        ],
        'faxx' => [
            0 => '464F524D........46415858',
        ],
        'fh8' => [
            0 => '41474433',
        ],
        'fits' => [
            0 => '53494D504C452020',
            1 => '3D202020202020202020202020202020202020202054',
        ],
        'flac' => [
            0 => '664C6143',
        ],
        'flif' => [
            0 => '464C4946',
        ],
        'gif' => [
            0 => '474946383761',
            1 => '474946383961',
        ],
        'gz' => [
            0 => '1F8B',
        ],
        'ibm' => [
            0 => '464F524D........494C424D',
        ],
        'ico' => [
            0 => '00000100',
        ],
        'idx' => [
            0 => '494E4458',
        ],
        'iff' => [
            0 => '464F524D........494C424D',
            1 => '464F524D........38535658',
            2 => '464F524D........4143424D',
            3 => '464F524D........414E424D',
            4 => '464F524D........414E494D',
            5 => '464F524D........46415858',
            6 => '464F524D........534D5553',
            7 => '464F524D........434D5553',
            8 => '464F524D........5955564E',
            9 => '464F524D........46414E54',
            10 => '464F524D........41494646',
        ],
        'ilbm' => [
            0 => '464F524D............494C424D',
        ],
        'iso' => [
            0 => '4344303031',
        ],
        'jar' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'jpeg' => [
            0 => 'FFD8FFDB',
            1 => 'FFD8FFE0....4A4649460001',
            2 => 'FFD8FFE1....457869660000',
        ],
        'jpg' => [
            0 => 'FFD8FFDB',
            1 => 'FFD8FFE0....4A4649460001',
            2 => 'FFD8FFE1....457869660000',
        ],
        'lbm' => [
            0 => '464F524D................494C424D',
        ],
        'lz' => [
            0 => '4C5A4950',
        ],
        'lz4' => [
            0 => '04224D18',
        ],
        'mid' => [
            0 => '4D546864',
        ],
        'midi' => [
            0 => '4D546864',
        ],
        'mk3d' => [
            0 => '1A45DFA3',
        ],
        'mka' => [
            0 => '1A45DFA3',
        ],
        'mks' => [
            0 => '1A45DFA3',
        ],
        'mkv' => [
            0 => '1A45DFA3',
        ],
        'mlv' => [
            0 => '4D4C5649',
            1 => '44434D0150413330',
        ],
        'mp3' => [
            0 => 'FFFB',
            1 => '494433',
        ],
        'msg' => [
            0 => 'D0CF11E0A1B11AE1',
        ],
        'mus' => [
            0 => '464F524D........534D5553',
            1 => '464F524D........434D5553',
        ],
        'nes' => [
            0 => '4E45531A',
        ],
        'odp' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'ods' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'odt' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'oga' => [
            0 => '4F676753',
        ],
        'ogg' => [
            0 => '4F676753',
        ],
        'ogv' => [
            0 => '4F676753',
        ],
        'pdb' => [
            0 => '000000000000000000000000000000000000000000000000',
        ],
        'pdf' => [
            0 => '25504446',
        ],
        'pic' => [
            0 => '00',
        ],
        'pif' => [
            0 => '00',
        ],
        'png' => [
            0 => '89504E470D0A1A0A',
        ],
        'ppt' => [
            0 => 'D0CF11E0A1B11AE1',
        ],
        'pptx' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'ps' => [
            0 => '25215053',
        ],
        'psd' => [
            0 => '38425053',
        ],
        'rar' => [
            0 => '526172211A0700',
            1 => '526172211A070100',
            2 => '7F454C46',
        ],
        'sea' => [
            0 => '00',
        ],
        'smu' => [
            0 => '464F524D........534D5553',
        ],
        'smus' => [
            0 => '464F524D........534D5553',
        ],
        'snd' => [
            0 => '464F524D........38535658',
            1 => '464F524D........41494646',
        ],
        'stg' => [
            0 => '4D494C20',
        ],
        'svx' => [
            0 => '464F524D........38535658',
        ],
        'tar' => [
            0 => '7573746172003030',
            1 => '7573746172202000',
        ],
        'tda' => [
            0 => '00014454',
            1 => '00010000',
        ],
        'tif' => [
            0 => '49492A00',
            1 => '4D4D002A',
        ],
        'tiff' => [
            0 => '49492A00',
            1 => '4D4D002A',
        ],
        'toast' => [
            0 => '455202000000',
            1 => '8B455202000000',
        ],
        'tox' => [
            0 => '746F7833',
        ],
        'vmdk' => [
            0 => '4B444D',
        ],
        'vsdx' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'wav' => [
            0 => '52494646........57415645',
        ],
        'webm' => [
            0 => '1A45DFA3',
        ],
        'wma' => [
            0 => '3026B2758E66CF11A6D900AA0062CE6C',
            1 => '2453444930303031',
        ],
        'wmv' => [
            0 => '3026B2758E66CF11A6D900AA0062CE6C',
            1 => '2453444930303031',
        ],
        'xar' => [
            0 => '78617221',
        ],
        'xls' => [
            0 => 'D0CF11E0A1B11AE1',
        ],
        'xlsx' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
        'ytr' => [
            0 => '00',
        ],
        'yuv' => [
            0 => '464F524D........5955564E',
        ],
        'yuvn' => [
            0 => '464F524D........5955564E',
        ],
        'z' => [
            0 => '1F9D',
            1 => '1FA0',
        ],
        'zip' => [
            0 => '504B0304',
            1 => '504B0506',
            2 => '504B0708',
        ],
    ];

    /**
     * @param string $filepath
     * @return bool
     */
    public function canBeValidated($filepath)
    {
        if (!file_exists($filepath)) {
            return false;
        }

        if (!is_readable($filepath)) {
            return false;
        }

        return isset($this->fileSignatures[$this->getFileExtension($filepath)]);
    }

    /**
     * @param string $filepath
     * @return string
     */
    public function getFileExtension($filepath)
    {
        if (strpos($filepath, chr(0)) !== false) {
            $filepath = substr($filepath, 0, strrpos($filepath, chr(0)));
        }

        return pathinfo($filepath, PATHINFO_EXTENSION);
    }

    /**
     * @param string $filepath
     * @return bool
     */
    public function isValid($filepath)
    {
        if (!file_exists($filepath)) {
            throw new \RuntimeException(
                sprintf(
                    'Cannot verify non-existing file "%s"',
                    $filepath
                ),
                1465575119
            );
        }

        if (!is_readable($filepath)) {
            throw new \RuntimeException(
                sprintf(
                    'Cannot verify non-readable file "%s"',
                    $filepath
                ),
                1465598391
            );
        }

        $extension = $this->getFileExtension($filepath);
        if (empty($extension)) {
            return false;
        }

        array_walk($this->fileSignatures, function (&$item) {
            $item = array_map('strtoupper', $item);
        });

        $maxSignatureLength = max(array_map('strlen', $this->fileSignatures[$extension])) / 2;

        $fileHandle = fopen($filepath, 'rb');
        $fileContent = bin2hex(fread($fileHandle, $maxSignatureLength));
        fclose($fileHandle);

        foreach ($this->fileSignatures[$extension] as $signature) {
            if (preg_match('/^' . $signature . '/i', $fileContent)) {
                return true;
            }
        }

        return false;
    }

}
