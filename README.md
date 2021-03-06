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

5) Edit export.php with your favourite text / code editor and add your newly created client ID and secret from Blipfoto, and username. *At the bottom of the file, there is a placeholder for those details. Don't change anything else.*

```
$backup = new Backup('Your Client ID Here','Your Client Secret Here');
$backup->run('Your Username (Not Email) Here');
```

6) Run

`php export.php`


## Gotchas

If using Linux, install git php5-cli curl & php5-curl first.
For example, with Ubuntu:

`sudo apt-get -y install git php5-cli curl php5-curl`

With OS X, you'll need to install either "Command Line Tools" from Apple's developer website.
Alternatively install Git from http://git-scm.com/download/mac
Or with Homebrew.

Hi-res photos not available (restriction in the API, there's nothing I can do about that).
Pulling photos, even your own might break Blipfoto's terms of use. I take no responsibility for the use of this tool, use at your own caution.
Only one photo of each entry is pulled. Additional photos are ignored.

Tested with OS X and Linux, might work on Windows if you install PHP (who knows? Who cares?).
