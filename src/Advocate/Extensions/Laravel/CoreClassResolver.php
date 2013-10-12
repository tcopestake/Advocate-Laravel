<?php

namespace Advocate\Extensions\Laravel;

class CoreClassResolver implements \Advocate\Interfaces\ClassResolver\ClassResolverInterface
{
    protected $composerLoader;

    public function resolve($class)
    {
        /* Try Composer */
        
        if ($this->composerLoader instanceof \Composer\Autoload\ClassLoader) {
            if (($file = $this->composerLoader->findFile($class))) {
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