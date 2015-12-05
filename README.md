# blipfoto-backup
A simple script to back up all your entries from Blipfoto

You can backup all of your entries with low-resolution photos and thumbnails, including description, title, tags etc as a JSON.

## How to use?

1) Download code

`git clone https://github.com/lahdekorpi/blipfoto-backup.git; cd blipfoto-backup`

2) Install composer (if not installed) getcomposer.org

`curl -sS https://getcomposer.org/installer | php`

3) Run composer

`php composer.phar install`

4) Goto Blipfoto and register an API key
https://www.polaroidblipfoto.com/developer/apps/create

5) Edit export.php and add your newly created client ID and secret from Blipfoto, and username:

```
$backup = new Backup('Your Client ID Here','Your Client Secret Here');
$backup->run('Your Username Here');
```

6) Run

`php export.php`


## Gotchas
Hi-res photos not available (restriction in the API, there's nothing I can do about that).
Pulling photos, even your own might break Blipfoto's terms of use. I take no responsibility for the use of this tool, use at your own caution.
Only one photo of each entry is pulled. Additional photos are ignored.

Tested with OS X and Linux, might work on Windows if you install PHP (who knows? Who cares?).
