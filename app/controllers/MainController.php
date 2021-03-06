<?php
require_once dirname(__FILE__) .'/../models/Selenium/Webdriver.php';
require_once dirname(__FILE__) .'/../models/Browsers/Twitter.php';

class MainController {

    private $is_headless;

    const PATH_TWITTER_URLS_FILE = './log/example.txt';

    function __construct($is_headless) {
        $this->is_headless = $is_headless;
    }

    public function main() {
        // ブラウザ起動
        $driver = Models_Webdriver::create($this->is_headless);
        $urls = file(self::PATH_TWITTER_URLS_FILE);
        $twitter = new Models_Browser_Twitter($driver);
        $twitter->login();
        foreach ($urls as $url) {
            $driver->get($url);
            echo "$url";
            $twitter->follow();
        }
        $driver->quit();
    }
}
