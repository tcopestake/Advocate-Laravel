<?php

namespace Advocate\Extensions\Laravel;

class CoreClassResolver implements \Advocate\Interfaces\ClassResolver\ClassResolverInterface
{
    protected $composerLoader;

    public function resolve($class)
    {echo 1;
        var_dump($this->composerLoader);
        exit;
        
        /* Try Composer */
        
        if ($this->composerLoader instanceof \Composer\Autoload\ClassLoader) {
            echo 1;
            exit;
            if (($file = $this->composerLoader->findFile($class))) {
                echo $file;
                exit;
                return $file;
            }
        }
        
        /* Try Laravel */
        
        if (class_exists('\\Illuminate\\Support\\ClassLoader', false)) {
            $classNormalized = \Illuminate\Support\ClassLoader::normalizeClass($class);

            foreach (\Illuminate\Support\ClassLoader::getDirectories() as $directory) {
                if (file_exists(($path = $directory.DIRECTORY_SEPARATOR.$classNormalized))) {
                    return $path;
                }
            }
        }
        
        return false;
    }

    public function setComposerLoader($loader)
    {
        $this->composerLoader = $loader;
        
        return $this;
    }
}