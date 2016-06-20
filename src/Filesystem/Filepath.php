<?php
namespace IchHabRecht\Filesystem;

class Filepath
{
    /**
     * @var
     */
    protected $directorySeparator;

    /**
     * @var bool
     */
    protected $ensureSeparator;

    /**
     * @param string $directorySeparator
     * @param bool $ensureDirectorySeparator
     * @throws \RuntimeException
     */
    public function __construct($directorySeparator = DIRECTORY_SEPARATOR, $ensureDirectorySeparator = false)
    {
        if ('/' !== $directorySeparator && '\\' !== $directorySeparator) {
            throw new \RuntimeException(
                sprintf(
                    'Directory separator must be "/" or "\\", "%s" given',
                    $directorySeparator
                ),
                1465455200
            );
        }
        $this->directorySeparator = $directorySeparator;
        $this->ensureSeparator = $ensureDirectorySeparator;
    }

    /**
     * Concatenates the given path parts with DIRECTORY_SEPARATOR constant.
     * Removes trailing forward and backward slashes.
     *
     * @return string
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function concatenate()
    {
        if (func_num_args() < 2) {
            throw new \RuntimeException(
                'You have to provide two or more paths that can be concatenated',
                1465426729
            );
        }

        $paths = func_get_args();
        foreach ($paths as $key => &$path) {
            if (!is_string($path)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Argument %s passed to %s must be of the type string, %s given',
                        $key + 1, __METHOD__, gettype($path)
                    ),
                    1465426779
                );
            }

            $path = $this->ensureSeparator ? $this->ensureDirectorySeparator($path) : $path;
            if (0 === $key) {
                $path = rtrim($path, $this->directorySeparator);
            } else {
                $path = trim($path, $this->directorySeparator);
            }
        }

        return implode($this->directorySeparator, $paths);
    }

    /**
     * Replaces forward and backward slashes with the given directory separator.
     *
     * @param string $path
     * @return string
     */
    public function ensureDirectorySeparator($path)
    {
        $replacePairs = array_fill_keys(['/', '\\'], $this->directorySeparator);

        return strtr($path, $replacePairs);
    }

    /**
     * Removes doubled directory separators.
     * Resolves relative paths.
     *
     * @param string $path
     * @return string
     */
    public function normalize($path)
    {
        $path = $this->ensureSeparator
            ? $this->ensureDirectorySeparator($path)
            : $path;
        $pregSeparator = preg_quote($this->directorySeparator, '/');
        $patterns = [
            '/' . $pregSeparator . '{2,}/',
            '/' . $pregSeparator . '(\.' . $pregSeparator . ')+/',
            '/([^' . $pregSeparator . '\.]+' . $pregSeparator . '(?R)*\.{2,}' . $pregSeparator . ')/',
            '/\.\.' . $pregSeparator . '/',
        ];
        $replacements = [
            $this->directorySeparator,
            $this->directorySeparator,
            '',
            '',
        ];

        return preg_replace($patterns, $replacements, $path);
    }
}