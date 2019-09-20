<?php
class backupLibrary {
	
	public function dumpMySql($database, $path = false, $host = '', $user = '', $password = ''){
        
        if(!$path) $path = dirname(__FILE__) . '/';
        $path = $path . 'dump_' . date('Y-m-d_His') . '.sql';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        exec("mysqldump --user={$user} --password={$password} --host={$host} {$database} --result-file={$path} 2>&1", $output);
        //var_dump($output);
	}
    
    /* Полный путь к папке для архивирования, Имя архива + путь */
    public function Zip($source, $destination){
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true){
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file){
                $file = str_replace('\\', '/', $file);
                
                // Ignore "." and ".." folders
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                    continue;
                
                $file = realpath($file);
                $file = str_replace('\\', '/', $file);
                
                if (is_dir($file) === true){
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }elseif (is_file($file) === true){
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }elseif (is_file($source) === true){
            $zip->addFromString(basename($source), file_get_contents($source));
        }
        return $zip->close();
    }
    
    public function clear($path_folder) {
        if (file_exists($path_folder . '/')) {
            foreach (glob($path_folder . '/*') as $file) {
                unlink($file);
            }
        }
    }
}
?>
