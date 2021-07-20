<?php
//  get SITE_KEY and SECRET_KEY for your site in https://www.google.com/recaptcha/admin
//  name: reCaptcha V3 MODULE

class RecaptchaModule
{
    const SITE_KEY = 'XXX';
    const SECRET_KEY = 'XXX';

    private function getCaptcha($secretKey)
    {
        $response = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . self::SECRET_KEY . '&response=' . $secretKey);
        $result = json_decode($response);
        return $result;
    }

    public function isChecked()
    {
        $scoreBotLevel = 0.5;
        if (isset($_POST['g-recaptcha-response'])) {
            $result = $this->getCaptcha($_POST['g-recaptcha-response']);
            //var_dump($result);
            if ($result->success == true && $result->score > $scoreBotLevel) {
                // echo "Succes!";
                return true;
            } else {
                //echo "You are a Robot!!";
                return false;
            }
        }
    }
}
?>