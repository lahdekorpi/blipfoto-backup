<?php
namespace BlipfotoBackup;

require 'vendor/autoload.php';
use Blipfoto\Api\Client;

class Backup {

    private $client;
    private $username;
    
    public function __construct($clientID,$clientSecret)
    {
        date_default_timezone_set('Europe/Helsinki');
        $this->debug('Starting up...');
        $this->client = new Client($clientID,$clientSecret);
    }

    private function debug($string)
    {
        $date = date("Y-m-d H:i:s");
        echo "[{$date}] {$string}\n";
    }

    private function entries($page)
    {
        $response = $this->client->get('entries/journal', [
            'username' => $this->username,
            'page_index' => $page
        ]);
        return $response->data();
    }

    private function savePhoto($url,$file)
    {
        $curl = curl_init($url);
        $f = fopen($file, 'wb');
        curl_setopt($curl, CURLOPT_FILE, $f);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_exec($curl);
        curl_close($curl);
        return fclose($f);
    }

    public function run($username,$page=0,$rootDir='./photos',$dirPerm=0777)
    {
        $this->username = $username;
        $done = false;

        while(!$done) {
            $this->debug("Getting page: {$page}");
            $res = $this->entries($page);
            foreach($res['entries'] as $entry) {
                $this->debug("Getting entry: {$entry['entry_id_str']}");
                $dir = "{$rootDir}/{$entry['username']}/{$entry['entry_id_str']}";
                @mkdir($dir, $dirPerm, true);
                $entryRes = $this->client->get('entry', [
                    'entry_id' => $entry['entry_id_str'],
                    'return_details' => true
                ]);
                file_put_contents($dir."/data.json",json_encode($entryRes->data()));
                $this->savePhoto($entry['thumbnail_url'],$dir."/thumbnail.jpg");
                $this->savePhoto($entry['image_url'],$dir."/image.jpg");
            }
            if(!$res['page']['more']) {
                $done=true;
            }
            $page++;
        }
        $this->debug('Done');
    }
}

$backup = new Backup('Your Client ID Here','Your Client Secret Here');
$backup->run('Your Username Here');
