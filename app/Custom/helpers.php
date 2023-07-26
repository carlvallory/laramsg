<?php
use App\Option;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as SupportFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

use App\Custom\Constants;

if(!function_exists('isHome')) {
    function isHome()
    {
        return Request::is('/');
    }
}
if(!function_exists('num_format')) {
    function num_format($val)
    {
        return number_format($val, 0, ',', '.');
    }
}

if(!function_exists('slug')) {
    function slug($str) {
        return Str::slug($str);
    }
}

if(!function_exists('trimText')) {
    function trimText($string, $length = 140) {
        return strlen($string) > $length ? substr(strip_tags(html_entity_decode($string)), 0, $length).' [...]' : $string;
    }
}

if(!function_exists('splitText')) {
    function splitText($text, $opening = null, $closing = null)
    {
        $output = [];
        $array = explode(PHP_EOL, $text);
        foreach($array as $element) {
            $output[] = $opening.$element.$closing;
        }

        return $output;
    }
}

if(!function_exists('toNumber')) {
    function toNumber($str)
    {
        return preg_replace('/[^0-9]+/', '', $str);
    }
}

if(!function_exists('toArray')) {
    function toArray($string)
    {
        return array_filter(explode(PHP_EOL, $string));
    }
}

if(!function_exists('tel')) {
    function tel($string)
    {
        return preg_replace('~\D~', '', $string);
    }
}

if(!function_exists('removeBreaks')) {
    function removeBreaks($string)
    {
        return preg_replace( "/\r|\n/", "", $string );
    }
}

if(!function_exists('camelize')) {
    function camelize($input, $separator = '-')
    {
        return str_replace($separator, '', lcfirst(ucwords($input, $separator)));
    }
}

if(!function_exists('uploads_url')) {
    function uploads_url($url) {
        return str_replace('public', 'uploads', $url);
    }
}

if(!function_exists('getMysqlVersion')){
    function getMysqlVersion()
    {
        $pdo     = DB::connection()->getPdo();
        $version = $pdo->query('select version()')->fetchColumn();

        (float)$version = mb_substr($version, 0, 6);
        
        // mysql >= 5.6 has fulltext index support
        if ($version < '5.7.8') {
            return false;
        }

        return true;
    }
}
if(!function_exists('is_mysql')){
    function is_mysql()
    {
        if(getMysqlServerType() == "MySQL") {
            return true;
        }
        return false;
    }
}
if(!function_exists('is_mariadb')){
    function is_mariadb()
    {
        if(getMysqlServerType() == "MariaDB") {
            return true;
        }
        return false;
    }
}
if(!function_exists('is_percona')){
    function is_percona()
    {
        if(getMysqlServerType() == "Percona Server") {
            return true;
        }
        return false;
    }
}
if(!function_exists('is_memcached')) {
    function is_memcached()
    {
        $var = parse_phpinfo()['memcached'];

        if(class_exists('Memcached')){
            return true;
        }
        return false;
    }
}
if(!function_exists('getMysqliVersion')){
    function getMysqliVersion()
    {
        return mysqli_get_client_version();
    }
}

if(!function_exists('getMysqlServerType')) {
    function getMysqlServerType()
    {
        $isMariaDb = false;
        $isPercona = false;

        $result = DB::select( DB::raw('SELECT @@version, @@version_comment') );
        $version = array_map(function ($value) {
                    return (array)$value;
                }, $result);

        foreach($version as $key => $v) {
            if (is_array($v)) {
                $versionString = $v['@@version'] ?? '';
                $versionInt = mysqlVersionToInt($versionString);
                $versionComment = $v['@@version_comment'] ?? '';
                if (stripos($versionString, 'mariadb') !== false) {
                    $isMariaDb = true;
                }
                if (stripos($versionComment, 'percona') !== false) {
                    $isPercona = true;
                }
            }
        }

        if ($versionInt > 50503) {
            $default_charset = 'utf8mb4';
            $default_collation = 'utf8mb4_general_ci';
        } else {
            $default_charset = 'utf8';
            $default_collation = 'utf8_general_ci';
        }

        if ($isMariaDb) {
            return 'MariaDB';
        }

        if ($isPercona) {
            return 'Percona Server';
        }

        return 'MySQL';
    }
}

if(!function_exists('mysqlVersionToInt')) {
    function mysqlVersionToInt($version)
    {
        $match = explode('.', $version);

        return (int) sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2]));
    }
}

if(!function_exists('is_valid_url')){
    function is_valid_url($string){
        $regex = "((https?|ftp)\:\/\/)?"; // SCHEME
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
        $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
        $regex .= "(\:[0-9]{2,5})?"; // Port
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

        if(preg_match("/^$regex$/", $string))
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('get_slug')){
    function get_slug($string){
        $slug = Arr::last(explode("/", $string), function ($value, $key) {
            return (Str::contains($value, '-'));
        });;
        return $slug;
    }
}
if(!function_exists('slug_to_str')){
    function slug_to_str($slug){
        if(Str::contains($slug, '-')) {
            return Str::title(str_replace('-', ' ', $slug));
        } else {
            return ucfirst($slug);
        }
    }
}
if(!function_exists('get_youtube_id')){
    function get_youtube_id($string) {
        preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#", $string, $match);
        return ($match[0][0]) ?? get_yt_id($string);
    }
}
if(!function_exists('get_yt_id')){
    function get_yt_id($string) {
        parse_str( parse_url( $string, PHP_URL_QUERY ), $params );

        foreach($params as $param => $value) {
            if(in_array($param, ['v', 'vi'])) {
                return $value;
            }
        }
    }
}
if(!function_exists('check_youtube_id')){
    function check_youtube_id($string){
        return preg_match('/^[a-zA-Z0-9_-]{11}$/', $string) > 0;
    }
}
if(!function_exists('get_youtube_object')){
    function get_youtube_object($url){
        if(check_youtube_id(get_youtube_id($url))){
            $youtube = "https://www.youtube.com/oembed?url=" . $url . "&format=json";
            $curl = curl_init($youtube);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $return = curl_exec($curl);
            curl_close($curl);
            return json_decode($return, true);
        }
        return (object)[];
    }
}

if(!function_exists('storage_file_exists')){
    function storage_file_exists($file_path) {
        if(Storage::exists(substr_replace($file_path, "", strpos($file_path, 'storage/'), 8))) {
            return true;
        }
        return false;
    }
}

if(!function_exists('real_path')){
    function real_path($path) {
        if(str::contains($path, 'storage') || str::contains($path, 'public')) {
            $sPathStart = strpos($path, 'storage/');
            $sPathLenght= strlen('storage/');
            $sSubPath  = substr_replace($path, '', 0, $sPathStart+$sPathLenght);

            $pPathStart = strpos($sSubPath, 'public/');
            if(!$pPathStart === false) {
                $pPathLenght= strlen('public/');
                $pSubPath  = substr_replace($sSubPath, '', 0, $pPathStart+$pPathLenght);
            } else {
                $pSubPath = $sSubPath;
            }

            $realPath = Storage::path($pSubPath);
        } else {
            $realPath = Storage::path($path);
        }
        return $realPath;
    }
}

if(!function_exists('relative_path')){
    function relative_path($path) {
        if(str::contains($path, 'storage') || str::contains($path, 'public')) {
            $sPathStart = strpos($path, 'storage/');
            $sPathLenght= strlen('storage/');
            if(!$sPathStart === false) {
                $sSubPath  = substr_replace($path, '', 0, $sPathStart+$sPathLenght);
            } else {
                $sSubPath = $path;
            }
            $pPathStart = strpos($sSubPath, 'public/');
            $pPathLenght= strlen('public/');
            if(!$pPathStart === false) {
                $pSubPath  = substr_replace($sSubPath, '', 0, $pPathStart+$pPathLenght);
            } else {
                $pSubPath = $sSubPath;
            }
        } else {
            return $path;
        }
        return $pSubPath;
    }
}

if(!function_exists('video_path')){
    function video_path($path, $sticky = 'media/youtube') {
        $sticky = rtrim($sticky, DIRECTORY_SEPARATOR);
        if(str::contains($path, 'youtube')) {
            $sPathStart = strpos($path, 'youtube/');
            $sPathLenght= strlen('youtube/');
            if(!$sPathStart === false) {
                $sSubPath  = substr_replace($path, '', 0, $sPathStart+$sPathLenght);
                $videoPath = $sticky . DIRECTORY_SEPARATOR . $sSubPath;
                return $videoPath;
            }
        }
        return $path;
    }
}

if(!function_exists('photo_path')){
    function photo_path($path, $sticky = 'media') {
        $sticky = rtrim($sticky, DIRECTORY_SEPARATOR);
        if(str::contains($path, 'thumbnails')) {
            $sPathStart = strpos($path, 'thumbnails/');
            $sPathLenght= strlen('thumbnails/');
            if(!$sPathStart === false) {
                $sSubPath  = substr_replace($path, '', 0, $sPathStart+$sPathLenght);
                $photoPath = $sticky . DIRECTORY_SEPARATOR . $sSubPath;
                return $photoPath;
            }
        }
        return $path;
    }
}

if(!function_exists('thumbnail_path')){
    function thumbnail_path($path, $sticky = 'media/thumbnails') {
        $sticky = rtrim($sticky, DIRECTORY_SEPARATOR);
        if(str::contains($path, 'thumbnails')) {
            $sPathStart = strpos($path, 'thumbnails/');
            $sPathLenght= strlen('thumbnails/');
            if(!$sPathStart === false) {
                $sSubPath  = substr_replace($path, '', 0, $sPathStart+$sPathLenght);
                $thumbnailPath = $sticky . DIRECTORY_SEPARATOR . $sSubPath;
                return $thumbnailPath;
            }
        }
        if(str::contains($path, 'media')) {
            $sMediaPathStart = strpos($path, 'media/');
            $sMediaPathLenght= strlen('media/');
            if(!$sMediaPathStart === false) {
                $sMediaSubPath  = substr_replace($path, '', 0, $sMediaPathStart+$sMediaPathLenght);
                $thumbnailMediaPath = $sticky . DIRECTORY_SEPARATOR . $sMediaSubPath;
                return $thumbnailMediaPath;
            }
        }

        return $path;
    }
}

if(!function_exists('checkDirectory')) {
    function checkDirectory($path) {
        if(!SupportFile::isDirectory($path)){
            SupportFile::makeDirectory($path, 0775, true, true);
        }
        return $path;
    }
}

if(!function_exists('generateTemporaryFile')) {
    function generateTemporaryFile($url) {
        $extension = pathinfo($url, PATHINFO_EXTENSION); 
        $dirPath = config('media.publicFolder');
        $tmpPath = storage_path('app/public' . DIRECTORY_SEPARATOR . $dirPath . DIRECTORY_SEPARATOR . 'tmp');
        $tmpFileName = tempnam( checkDirectory($tmpPath), "YTTHUMBNAIL_");
        if (file_exists($tmpFileName)) {
            $tmpFileNameWithExtension = $tmpFileName . '.' . $extension;
            $tmpFileRename = rename($tmpFileName, $tmpFileName . '.' . $extension);
        }

        $tmpFile = file_get_contents($url);
        file_put_contents($tmpFileNameWithExtension, $tmpFile);

        return $tmpFileNameWithExtension;
    }
}

if(!function_exists('generateThumbnailFromYoutube')) {
    function generateThumbnailFromYoutube($url) {
        $extension = pathinfo($url, PATHINFO_EXTENSION); 
        $dirPath = config('media.publicFolder');
        $tmpPath = storage_path('app/public' . DIRECTORY_SEPARATOR . $dirPath . DIRECTORY_SEPARATOR. 'youtube');
        $tmpFileName = tempnam( checkDirectory($tmpPath), "YTTHUMBNAIL_");
        if (file_exists($tmpFileName)) {
            $tmpFileNameWithExtension = $tmpFileName . '.' . $extension;
            $tmpFileRename = rename($tmpFileName, $tmpFileName . '.' . $extension);
        }

        $tmpFile = file_get_contents($url);
        file_put_contents($tmpFileNameWithExtension, $tmpFile);

        return $tmpFileNameWithExtension;
    }
}

if(!function_exists('guessMimeType')){
    function guessMimeType(string $path)
    {
        $realPath = real_path($path);

        if (!is_file($realPath) || !is_readable($realPath)) {
            return null;
        }

        if (false === $mimeType = mime_content_type($realPath)) {
            return null;
        }

        if ($mimeType && 0 === (\strlen($mimeType) % 2)) {
            $mimeStart = substr($mimeType, 0, \strlen($mimeType) >> 1);
            $mimeType = $mimeStart.$mimeStart === $mimeType ? $mimeStart : $mimeType;
        }
        return $mimeType;
    }
}

if(!function_exists('getExtensions')){
    function getExtensions(string $mimeType)
    {
        return Constants::MAP[$mimeType] ?? Constants::MAP[strtolower($mimeType)] ?? [];
    }
}

if(!function_exists('getMimeType')){
    function getMimeType($path)
    {   
        if(STR::contains($path, ['https', 'http'])) {
            $tmpFilePath = generateTemporaryFile($path);
            $info = new SplFileInfo($tmpFilePath);
        } else {
            $info = new SplFileInfo($path);
            //$mime = guessMimeType($info->getPathname());
        }

        return guessMimeType($info->getPathname());
    }
}

if(!function_exists('guessExtension')){
    function guessExtension($path = null){
        return getExtensions((is_null(getMimeType($path))) ? getMimeType($path) : "")[0] ?? null;
    }
}

if(!function_exists('hashName')){
    function hashName($path = null){
        if ($path) {
            $path = rtrim($path, '/');
        }

        $ePath = explode('/', $path);
        $eFile = array_pop($ePath);

        $hash = Str::random(40);

        if ($extension = guessExtension($path)) {
            $extension = '.'.$extension;
        }

        $iFile = array_push($ePath, $hash.$extension);
        $iPath = implode(DIRECTORY_SEPARATOR, $ePath);
        
        return $iPath;
    }
}

if(!function_exists('parse_phpinfo')){
    function parse_phpinfo() {
        ob_start(); phpinfo(INFO_MODULES); $s = ob_get_contents(); ob_end_clean();
        $s = strip_tags($s, '<h2><th><td>');
        $s = preg_replace('/<th[^>]*>([^<]+)<\/th>/', '<info>\1</info>', $s);
        $s = preg_replace('/<td[^>]*>([^<]+)<\/td>/', '<info>\1</info>', $s);
        $t = preg_split('/(<h2[^>]*>[^<]+<\/h2>)/', $s, -1, PREG_SPLIT_DELIM_CAPTURE);
        $r = array(); $count = count($t);
        $p1 = '<info>([^<]+)<\/info>';
        $p2 = '/'.$p1.'\s*'.$p1.'\s*'.$p1.'/';
        $p3 = '/'.$p1.'\s*'.$p1.'/';
        for ($i = 1; $i < $count; $i++) {
            if (preg_match('/<h2[^>]*>([^<]+)<\/h2>/', $t[$i], $matchs)) {
                $name = trim($matchs[1]);
                $vals = explode("\n", $t[$i + 1]);
                foreach ($vals AS $val) {
                    if (preg_match($p2, $val, $matchs)) { // 3cols
                        $r[$name][trim($matchs[1])] = array(trim($matchs[2]), trim($matchs[3]));
                    } elseif (preg_match($p3, $val, $matchs)) { // 2cols
                        $r[$name][trim($matchs[1])] = trim($matchs[2]);
                    }
                }
            }
        }
        return $r;
    }
}

if(!function_exists('return_bytes')){
    function return_bytes($val)
    {
        $val  = trim($val);

        if (is_numeric($val))
            return $val;

        $last = strtolower($val[strlen($val)-1]);
        $val  = substr($val, 0, -1);

        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }
}

if(!function_exists('return_kilobytes')){
    function return_kilobytes($val)
    {
        $val  = trim($val);

        if (is_numeric($val))
            return $val;

        $last = strtolower($val[strlen($val)-1]);
        $val  = substr($val, 0, -1);

        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
        }

        return $val;
    }
}

if(!function_exists('is_base64')){
    function is_base64($string){
        if (strlen($string)%4!==0) return false;
        // Check if there are valid base64 characters
        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

        // Decode the string in strict mode and check the results
        $decoded = base64_decode($string, true);
        if(false === $decoded) return false;

        // Encode the string again
        if(base64_encode($decoded) != $string) return false;

        return true;
    }
}

if(!function_exists('base_decoded')){
    function base_decoded($string) { 
        if (preg_match('/([\w ]+)/imu', $string)){ return true; } 
        return false; 
    }
}

if(!function_exists('while_decode')){
    function while_decode($string) {
        if(!Str::contains($string, "_")) { return $string; }
        $arr = explode("_", $string);
        $string = $arr[0];
        $n = $arr[1];
        $i = 0;
        
        while ($i < $n) {
            $i++;
            $string = base64_decode($string);
        }

        return $string;
    }
}

if(!function_exists('strip_number')){
    function strip_number($string) {
        if(!Str::contains($string, "@")) { return $string; }
        $arr = explode("@", $string);
        $string = $arr[0];

        $countChar = strlen($string) - 3;
        $character = str_repeat("#", $countChar);
        
        $result = Str::substr($string, $countChar, 3);
        $string = $character . $result;
        return $string;
    }
}
