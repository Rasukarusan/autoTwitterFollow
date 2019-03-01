<?php 
require_once dirname(__FILE__) . '/../Selenium/Base.php';
require_once dirname(__FILE__) . '/../Accounts/Twitter.php';
use Facebook\WebDriver\WebDriverKeys;

class Models_Browser_Twitter extends Models_Selenium_Base {

    const URL_LOGIN = 'https://twitter.com/login';

    public function login() {
        $this->driver->get(self::URL_LOGIN);
        $twitter = new Models_Account_Twitter();
        $this->findElementsByClass('email-input')[1]->sendKeys($twitter->user_id);
        $this->findElementsByClass('js-password-field')[0]->sendKeys($twitter->password);
        $this->findElementsByClass('submit')[1]->sendKeys(WebDriverKeys::ENTER);
    }

    public function follow() {
        $follow_btns = $this->findElementsByClass('user-actions-follow-button');
        if(!isset($follow_btns[0])) {
            echo "該当のページが存在しません\n";
            return;
        }
        $follow_btn = $follow_btns[0];
        if(strpos($follow_btn->getText(),'フォロー中') !== false){
            echo "既にフォロー済みです\n";
            return ;
        }
        $follow_btn->click();
    }

}
