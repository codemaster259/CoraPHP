<?php

function define_urls($file = null){
    
    if(!$file)
    {
        $file = __FILE__;
    }
    
    $urls = array();
    
    $core_root = str_replace(DIRECTORY_SEPARATOR,"/",(dirname($file)."/"));
    
    $doc_root = $_SERVER['DOCUMENT_ROOT'];
    
    $core_folder = str_replace($doc_root, "", $core_root );
    
    if($core_folder == "/")
    {
        $core_folder = "";
    }

    $scheme = (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? "https://" : "http://";
    
    $core_url = $scheme.$_SERVER['SERVER_NAME']."/".$core_folder;
    
    $real_url = $scheme.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        
    $request_url = parse_url(rtrim("/".str_replace($core_url,"",$real_url),'/'), PHP_URL_PATH);
    
    if($request_url == "")
    {
        $request_url = "/";
    }
    
    //include/require folder
    $urls["CORE_ROOT"] = $core_root;
    //html 'base' tag
    $urls["CORE_URL"] = $core_url;
    //full request url
    $urls["REAL_URL"] = $real_url;
    //custom request uri fragment
    $urls["REQUEST_URL"] = $request_url;
    
    return $urls;
}