<?php


include __SOURCE__ . 'dist/php/Pages/Forms/FormException.php';
include __SOURCE__ . 'dist/php/Pages/Forms/Elements/Types/TagsClass.php';
include __SOURCE__ . 'dist/php/Pages/Forms/Elements/Types/NonClosableTag.php';
include __SOURCE__ . 'dist/php/Pages/Forms/Elements/Types/ClosableTagContent.php';
include __SOURCE__ . 'dist/php/Pages/Forms/Elements/Types/ClosableTag.php';
include __SOURCE__ . 'dist/php/Pages/Forms/Elements/Attrs/Props.php';
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Pages/Forms/Elements/Attrs/Style/Props/Prior/')),'/\.php$/') as $phpFile) {
    include $phpFile->getRealPath();
}
if ($handle = opendir(__SOURCE__.'dist/php/Pages/Forms/Elements')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." and !is_dir(__SOURCE__.'dist/php/Pages/Forms/Elements/'.$entry)) {
            include __SOURCE__.'dist/php/Pages/Forms/Elements/'.$entry;
        }
    }

    closedir($handle);
}

if ($handle = opendir(__SOURCE__.'dist/php/Pages/Forms/Elements/Attrs')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." and is_dir(__SOURCE__.'dist/php/Pages/Forms/Elements/Attrs/'.$entry)) {
            $arr = [];
            foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__.'dist/php/Pages/Forms/Elements/Attrs/'.$entry)), '/\.php$/') as $phpFile) {
                $arr[] = $phpFile;
//                include $phpFile->getRealPath();
            }
            $arr = array_reverse($arr);

            foreach ($arr as $phpFile) {
                include $phpFile->getRealPath();
            }
        }
    }

    closedir($handle);
}
include __SOURCE__.'dist/php/Pages/Forms/Elements/HtmlTags.php';
