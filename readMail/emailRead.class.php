<?php
set_time_limit(0);
$obj = new Email_reader();
$res = $obj -> get();
// print_r($res);
class Email_reader {

    // imap server connection
    public $conn;

    // inbox storage and inbox message count
    private $inbox;
    private $msg_cnt;

    // email login credentials
    private $server = 'imap.exmail.qq.com';
    private $user   = 'wusong@banmatrip.com';
    private $pass   = 'Ws3391095';
    private $port   = 143; // adjust according to server settings

    // connect to the server and get the inbox emails
    function __construct() {
        $this->connect();
        $this->inbox();
    }

    // close the server connection
    function close() {
        $this->inbox = array();
        $this->msg_cnt = 0;

        imap_close($this->conn);
    }

    // open the server connection
    // the imap_open function parameters will need to be changed for the particular server
    // these are laid out to connect to a Dreamhost IMAP server
    function connect() {
        $this->conn = imap_open('{'.$this->server.'/notls}', $this->user, $this->pass);
    }

    // move the message to a new folder
    function move($msg_index, $folder='INBOX.Processed') {
        // move on server
        imap_mail_move($this->conn, $msg_index, $folder);
        imap_expunge($this->conn);

        // re-read the inbox
        $this->inbox();
    }

    // get a specific message (1 = first email, 2 = second email, etc.)
    function get($msg_index=NULL) {
        if (count($this->inbox) <= 0) {
            return array();
        }
        elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
            return $this->inbox[$msg_index];
        }

        return $this->inbox[0];
    }

    // read the inbox
    function inbox() {
        $this->msg_cnt = imap_num_msg($this->conn);

        $in = array();
        for($i = 1; $i <= 11; $i++) {
            $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($this->conn, $i),
                'body'      => $this->getBody($i),
                'structure' => imap_fetchstructure($this->conn, $i)
            );
        }

        $this->inbox = $in;
    }

    function getBody($i)
    {
        $bodyContent1 = imap_body($this->conn, $i);
        $bodyContent2 = imap_fetchbody($this->conn, $i ,0);
        $bodyContent3 = imap_fetchstructure($this->conn, $i ,0);
        $fromEncoding = $bodyContent3->parameters[0]->value;
        // $text = mb_convert_encoding($bodyContent2, 'utf-8', $fromEncoding);
        if($bodyContent3->encoding == 3) {
            $text = imap_base64($text);
        } else if($bodyContent3->encoding == 4) {
            $text = imap_qprint($text);
        }
        var_dump($bodyContent3);
    }

}

?>