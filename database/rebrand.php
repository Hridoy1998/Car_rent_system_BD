<?php

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/../resources/views'));
$count = 0;
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $c = file_get_contents($file->getPathname());
        $nc = str_ireplace(['Neon Monolith', 'NEON MONOLITH'], ['Car Rent System', 'Car Rent System'], $c);
        if ($c !== $nc) {
            file_put_contents($file->getPathname(), $nc);
            $count++;
        }
    }
}
echo "Updated $count files.\n";
