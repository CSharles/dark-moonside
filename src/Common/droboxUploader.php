<?php
namespace VirtualRoom\Common;
class dropboxUploader
{
    protected $authorization= "Authorization: Bearer lqRQVy1o1zAAAAAAAAAAY86KBCdX7tKpFygrgfRdGq4-ufCZV8wDG8y8xilXnCWk";
    public static function doUpload(string $path, string $fname):string
    {
        $pathlocal = $path;
        $name=$fname;
        $fp = fopen($pathlocal, 'rb');
        $size = filesize($pathlocal);

        $cheaders = array($this->authorization,
                        'Content-Type: application/octet-stream',
                        'Dropbox-API-Arg: {"path":"/fromWeb/'.$name.'", "mode":"add","autorename":true}');

        $ch = curl_init('https://content.dropboxapi.com/2/files/upload');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, $size);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        
        $deco=json_decode($response,true);
        return $phathDropBox=$deco['path_display'];

    }

    public static function createSharedLink(string $phathDropBox):string
    {
         $parameters = array('path' => $phathDropBox);

         $headers = array($this->authorization,
                         'Content-Type: application/json');
 
         $curlOptions = array(
                 CURLOPT_HTTPHEADER => $headers,
                 CURLOPT_POST => true,
                 CURLOPT_POSTFIELDS => json_encode($parameters),
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_VERBOSE => true
             );
 
         $ch = curl_init('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings');
         curl_setopt_array($ch, $curlOptions);
 
         $response = curl_exec($ch);
         curl_close($ch);
 
         $deco=json_decode($response,true);
         $imgurldl=substr($deco['url'], 0, -1);
         return $imgurl=$imgurldl."1";
    }

}