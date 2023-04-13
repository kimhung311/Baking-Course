<?php

use Illuminate\Support\Str;

if (!function_exists('getEmailSuffix')) {
    function getEmailSuffix(string $email)
    {
        $emailExplode = explode('@', $email);
        return  isset($emailExplode[1]) ? $emailExplode[1] : null;
    }
}

if (!function_exists('getCodeUUID')) {
    function getCodeUUID()
    {
        return (string) Str::uuid();
    }
}

/*
 * Global helpers file with misc functions.
 */
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('camelcase_to_word')) {

    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return auth()->user()->is_admin;
    }
}

if (!function_exists('addVersionUrl')) {
    function addVersionUrl($url)
    {
        if (strpos($url, '?') === false) {
            return $url . '?v=' . date('Y_m_d_H_i_s');
        }
        return $url . '&v=' . date('Y_m_d_H_i_s');
    }
}

if (!function_exists('replaceUrlToLinkTag')) {
    function replaceUrlToLinkTag($str)
    {
        $reg_exUrl = "/(http|https|ftp|ftps)\\:\\/\\/[a-zA-Z0-9\\-\\.]+\\.[a-zA-Z]{2,3}(\\/\\S*)?/";
        $urls = array();
        $urlsToReplace = array();
        if (preg_match_all($reg_exUrl, $str, $urls)) {
            $linkUrls = array_unique($urls[0]);
            $numOfMatches  = count($linkUrls);
            for ($i = 0; $i < $numOfMatches; $i++) {
                $str = str_replace($linkUrls[$i], ' <a target="_blank" href="' . $linkUrls[$i] . '">' . $linkUrls[$i] . '</a> ', $str);
            }
        }
        return $str;
    }
}

if (!function_exists('include_route_files')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
