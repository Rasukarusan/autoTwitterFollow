# twitter-auto-follow

Twitter follow automation by selenium-php.

# Usage

```sh
# no headless
$ php batch/run.php

# headless
$ php batch/run.php 1
```

# Setting 

- Input your twitter account info.

```sh
$ cd twitter-auto-follow
$ cp account_example.json account.json

# Input your twitter account info.
$ vim account.json
```

- Create Twitter URLs file.

```sh
$ cd twitter-auto-follow/log
$ vim twitter_urls.txt

https://twitter.com/XXXXXXX
https://twitter.com/YYYYYYY
https://twitter.com/ZZZZZZZ
....
```

You can use prepared shell script to collect twitter urls.
This script collect urls from qiita.
```sh 
$ cd twitter-auto-follow/batch
$ sh getTwitterAccountFromQiita.sh
```

- Run selenium server

```sh 
# example
java -jar /Library/java/Extensions/selenium-server-standalone-3.4.0.jar 
```
