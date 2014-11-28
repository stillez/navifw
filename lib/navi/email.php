<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email
 *
 * @author JanThanh
 */
require Navi::$config['basePath'] . '/lib/phpmailer/class.smtp.php';
require Navi::$config['basePath'] . '/lib/phpmailer/class.pop3.php';
require Navi::$config['basePath'] . '/lib/phpmailer/class.phpmailer.php';

class Navi_Email extends PHPMailer {

    public $from;
    public $toMails;
    public $ccMails;
    public $bccMails;

    public function __construct() {
        $this->isSMTP();
        $this->SMTPDebug = Navi::$config['mail']['SMTPDebug'];
        $this->Host = Navi::$config['mail']['Host'];
        $this->Port = Navi::$config['mail']['Port'];
        $this->SMTPSecure = Navi::$config['mail']['SMTPSecure'];
        $this->SMTPAuth = Navi::$config['mail']['SMTPAuth'];
        $this->Username = Navi::$config['mail']['Username'];
        $this->Password = Navi::$config['mail']['Password'];
    }

    public function resetTo() {
        $this->to = array();
    }

    public function resetCC() {
        $this->cc = array();
    }

    public function resetBCC() {
        $this->bcc = array();
    }

    public function sendMail() {
        if (is_array($this->from)) {
            $this->setFrom($this->from['email'], $this->from['name']);
        } else {
            $this->setFrom($this->from);
        }

        if ($this->toMails != null) {
            if (is_array($this->toMails)) {
                if (isset($this->toMails[0]['email'])) {
                    foreach ($this->toMails as $item) {
                        if (is_array($item)) {
                            $this->addAddress($item['email'], $item['name']);
                        } else {
                            $this->addAddress($item);
                        }
                    }
                } else {
                    $this->addAddress($this->toMails['email'], $this->toMails['name']);
                }
            } else {
                $this->addAddress($this->toMails);
            }
        }

        if ($this->ccMails != null) {
            if (is_array($this->ccMails)) {
                if (isset($this->ccMails[0]['email'])) {
                    foreach ($this->ccMails as $item) {
                        if (is_array($item)) {
                            $this->addCC($item['email'], $item['name']);
                        } else {
                            $this->addCC($item);
                        }
                    }
                } else {
                    $this->addCC($this->ccMails['email'], $this->ccMails['name']);
                }
            } else {
                $this->addCC($this->ccMails);
            }
        }

        if ($this->bccMails != null) {
            if (is_array($this->bccMails)) {
                if (isset($this->bccMails[0]['email'])) {
                    foreach ($this->bccMails as $item) {
                        if (is_array($item)) {
                            $this->addBCC($item['email'], $item['name']);
                        } else {
                            $this->addBCC($item);
                        }
                    }
                } else {
                    $this->addBCC($this->bccMails['email'], $this->bccMails['name']);
                }
            } else {
                $this->addBCC($this->bccMails);
            }
        }
        if (!$this->send()) {
            return $this->ErrorInfo;
        } else {
            return true;
        }
    }

}
