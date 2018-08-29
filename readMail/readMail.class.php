<?php
class Receivemail
{
    var $server='';
    var $username='';
    var $password='';

    var $marubox='';

    var $email='';

    public function __construct($username, $password, $EmailAddress, $mailserver = 'localhost', $servertype = 'pop', $port = '110', $ssl = false)
    { //Constructure
        if ($servertype == 'imap') {
            if ($port == '')
                $port = '143';
            $strConnect = '{' . $mailserver . ':' . $port . '/imap/ssl}INBOX';
        } else {
            $strConnect = '{' . $mailserver . ':' . $port . '/pop3' . ($ssl ? "/ssl" : "") . '}INBOX';
        }
        $this->server = $strConnect;
        $this->username = $username;
        $this->password = $password;
        $this->email = $EmailAddress;
    }

    function connect() //Connect To the Mail Box
    {
        $this->marubox=@imap_open($this->server,$this->username,$this->password);

        if(!$this->marubox)
        {
            echo "Error: Connecting to mail server";
            exit;
        }
        return true;
    }


    function getHeaders($mid) // Get Header info
    {
        if(!$this->marubox){
            return false;
        }

        $mail_header=imap_header($this->marubox,$mid);
        $sender=$mail_header->from[0];
        $sender_replyto=$mail_header->reply_to[0];

        if(strtolower($sender->mailbox)!='mailer-daemon' && strtolower($sender->mailbox)!='postmaster') {
            $subject=$this->decode_mime($mail_header->subject);
            $ccList=array();
            if(isset($mail_header->cc)){
                foreach ($mail_header->cc as $k => $v) {
                    $ccList[]=$v->mailbox.'@'.$v->host;
                }
            }

            $toList=array();
            if(isset($mail_header->to)){
                foreach ($mail_header->to as $k => $v) {
                    $toList[]=$v->mailbox.'@'.$v->host;
                }
            }
            $ccList=implode(",", $ccList);
            $toList=implode(",", $toList);
            $mail_details=array(
                'fromBy'=>strtolower($sender->mailbox).'@'.$sender->host,
                'fromName'=>$this->decode_mime($sender->personal),
                'ccList'=>$ccList,
                'toNameOth'=>$this->decode_mime($sender_replyto->personal),
                'subject'=>$subject,
                'mailDate'=>date("Y-m-d H:i:s",$mail_header->udate),
                'udate'=>$mail_header->udate,
                'toList'=>$toList,
               'seen' => $mail_header->Unseen
            );
        }
        return $mail_details;
    }

    function get_mime_type(&$structure) //Get Mime type Internal Private Use
    {
        $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");

        if($structure->subtype && $structure->subtype!="PNG") {
            return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;
        }
        return "TEXT/PLAIN";
    }


    function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false)
    {
        if(!$structure) {
            $structure = imap_fetchstructure($stream, $msg_number);
        }
        if($structure) {
            if($mime_type == $this->get_mime_type($structure)) {
                if(!$part_number) {
                    $part_number = "1";
                }
                $fromEncoding = $structure->parameters[0]->value;
                $text = imap_fetchbody($stream, $msg_number, $part_number);

                if($structure->encoding == 3) {
                    $text = imap_base64($text);
                } else if($structure->encoding == 4) {
                    $text = imap_qprint($text);
                }
                $text = mb_convert_encoding($text, 'gb2312', $fromEncoding);
                // $text = iconv($fromEncoding,'gb2312',$text);
                return $text;
            }
            if($structure->type == 1) {
                while(list($index, $sub_structure) = each($structure->parts)) {
                    if($part_number) {
                        $prefix = $part_number . '.';
                    }else{
                        $prefix = '';
                    }
                    $data = $this->get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
                    if($data) {
                        return $data;
                    }
                }
            }
        }
        return false;
    }

    function getTotalMails()
    {
        if (!$this->marubox){
            return false;
        }
        $check = imap_check($this->marubox);
        return $check->Nmsgs;
    }

    function GetAttach($mid,$path) // Get Atteced File from Mail
    {
        if(!$this->marubox){
            return [];
        }
        $struckture = imap_fetchstructure($this->marubox,$mid);
        // echo '<pre>';
        //     print_r($struckture);
        // echo '</pre>';
        $files=array();
        if(isset($struckture->parts) && $struckture->parts) {
            foreach($struckture->parts as $key => $value) {
                $enc=$struckture->parts[$key]->encoding;
                //取邮件附件
                if($struckture->parts[$key]->ifdparameters) {
                    //命名附件,转码
                    $name=$this->decode_mime($struckture->parts[$key]->dparameters[0]->value);
                    $extend =explode("." , $name);
                    $file['extension'] = $extend[count($extend)-1];
                    $file['pathname']  = $this->setPathName($key, $file['extension']);
                    $file['title']     = !empty($name) ? htmlspecialchars($name) : str_replace('.' . $file['extension'], '', $name);
                    $file['size']      = @$struckture->parts[$key]->dparameters[1]->value;
                    // $file['tmpname']   = $struckture->parts[$key]->dparameters[0]->value;
                    if(@$struckture->parts[$key]->disposition=="ATTACHMENT") {
                        $file['type']      = 1;
                    } else {
                        $file['type']      = 0;
                    }
                    $files[] = $file;
                    $message = imap_fetchbody($this->marubox,$mid,$key+1);
                    if ($enc == 0)
                        $message = imap_8bit($message);
                    if ($enc == 1)
                        $message = imap_8bit ($message);
                    if ($enc == 2)
                        $message = imap_binary ($message);
                    if ($enc == 3)//图片
                        $message = imap_base64 ($message);
                    if ($enc == 4)
                        $message = quoted_printable_decode($message);
                    if ($enc == 5)
                        $message = $message;
                    $fp=fopen($path.$file['pathname'],"w");
                    fwrite($fp,$message);
                    fclose($fp);
                }
                // 处理内容中包含图片的部分
                // echo '<pre>';
                // print_r($struckture->parts[$key] );
                // echo '</pre>';
                // if(isset($struckture->parts[$key]->parts) && $struckture->parts[$key]->parts) {
                if(isset($struckture->parts[$key]) && $struckture->parts[$key]) {
                    // foreach($struckture->parts[$key]->parts as $keyb => $valueb) {
                        // $enc=$struckture->parts[$key]->parts[$keyb]->encoding;
                        $enc=$struckture->parts[$key]->encoding;
                        // if($struckture->parts[$key]->parts[$keyb]->ifdparameters) {
                        if($struckture->parts[$key]->type == 5) {
                            //命名图片
                            // $name=$this->decode_mime($struckture->parts[$key]->dparameters[0]->value);
                            $name = $this->decode_mime($struckture->parts[$key]->parameters[0]->value);
                            // $extend =explode("." , $name);
                            $extend = $struckture->parts[$key]->subtype;
                            // $file['extension'] = $extend[count($extend)-1];
                            $file['extension'] = $extend;
                            // $file['pathname']  = $this->setPathName($key, $file['extension']);
                            $file['pathname']  = md5($struckture->parts[$key]->id).'.'.$extend;
                            $file['title']     = !empty($name) ? htmlspecialchars($name) : str_replace('.' . $file['extension'], '', $name);
                            // $file['size']      = $struckture->parts[$key]->parts[$keyb]->dparameters[1]->value;
                            // $file['tmpname']   = $struckture->parts[$key]->dparameters[0]->value;
                            $file['type']      = 0;
                            $files[] = $file;

                            // $partnro = ($key+1).".".($keyb+1);
                            $partnro = ($key+1);

                            $message = imap_fetchbody($this->marubox,$mid,$partnro);

                            if ($enc == 0)
                                $message = imap_8bit($message);
                            if ($enc == 1)
                                $message = imap_8bit ($message);
                            if ($enc == 2)
                                $message = imap_binary ($message);
                            if ($enc == 3)
                                $message = imap_base64 ($message);
                            if ($enc == 4)
                                $message = quoted_printable_decode($message);
                            if ($enc == 5)
                                $message = $message;
                            // echo '<pre>';
                            //     print_r($message );
                            // echo '</pre>';
                            $fp=fopen($path.$file['pathname'],"w");
                            fwrite($fp,$message);
                            fclose($fp);
                        }
                    // }

                }
            }
        }
        //move mail to taskMailBox
        $this->move_mails($mid, $this->marubox);
        return $files;
    }

    function getBody($mid,&$path,$imageList) // Get Message Body
    {
        if(!$this->marubox)
            return false;

        $body = $this->get_part($this->marubox, $mid, "TEXT/HTML");

        if ($body == ""){
            $body = $this->get_part($this->marubox, $mid, "TEXT/PLAIN");
        }
        if ($body == "") {
            return "";
        }
        //处理图片
        $body=$this->embed_images($body,$path,$imageList);
        return $body;
    }

    function embed_images(&$body,&$path,$imageList)
    {
        if(!$imageList){
            return $body;
        }
        // echo '<pre>';
        //     print_r($imageList);
        // echo '</pre>';
        // get all img tags
        preg_match_all('/<img.*?>/', $body, $matches);

        if (!isset($matches[0])) return;

        foreach ($matches[0] as $img) {
            // replace image web path with local path
            preg_match('/src="(.*?)"/', $img, $m);
            if (!isset($m[1])) continue;
            $arr = parse_url($m[1]);
            // var_dump($arr);
            if (!isset($arr['scheme']) || !isset($arr['path']))continue;

            // if (!isset($arr['host']) || !isset($arr['path']))continue;
            if ($arr['scheme']!="http" && $arr['scheme']!="https")
            {
                $filename = md5(($arr['path']));

                $type = $this->findImageByName($path.$filename);
                $imagePath = $path.$filename.'.'.$type;
                // echo '<pre>';
                // var_dump($filename.'.'.$type,$imageList);
                // echo '</pre>';
                $body = str_replace($img, '<img alt="" src="'.$imagePath.'" style="border: none;" />', $body);
            }
        }
        return $body;
    }

    function findImageByName($imageName)
    {
        $typeList = ['PNG','JPEG','JPG','JPEG','GIF'];
        foreach ($typeList as $type) {
            $filename = $imageName . '.' . $type;
            if(file_exists($filename)){
                return $type;
            }
        }
        return '';
    }

    function deleteMails($mid) // Delete That Mail
    {
        if(!$this->marubox)
            return false;

        imap_delete($this->marubox,$mid);
    }
    function close_mailbox() //Close Mail Box
    {
        if(!$this->marubox)
            return false;

        imap_close($this->marubox,CL_EXPUNGE);
    }

    //移动邮件到指定分组
    function move_mails($msglist,$mailbox)
    {
        if(!$this->marubox)
            return false;
        // imap_mail_move($this->marubox, $msglist, $mailbox);
    }

    function creat_mailbox($mailbox)
    {
        if(!$this->marubox)
            return false;

        //imap_renamemailbox($imap_stream, $old_mbox, $new_mbox);
        imap_create($this->marubox, $mailbox);
    }

    /*
     * decode_mime()转换邮件标题的字符编码,处理乱码
     */
    function decode_mime($str){
        $str=imap_mime_header_decode($str);
        return $str[0]->text;
        return imap_utf8($str[0]->text);
        if ($str[0]->charset != "UTF-8") {
            return iconv($str[0]->charset,'UTF-8',$str[0]->text);
            return mb_convert_encoding($str[0]->text,'utf8',$str[0]->charset);
        } else {
            return $str[0]->text;
        }
    }

    /**
     * Set path name of the uploaded file to be saved.
     *
     * @param  int    $fileID
     * @param  string $extension
     * @access public
     * @return string
     */
    public function setPathName($fileID, $extension)
    {
        return date('Ym/dHis', time()) . $fileID . mt_rand(0, 10000) . '.' . $extension;
    }

    public function mailRead($msgCount) {
        $status = imap_setflag_full($this->marubox, $msgCount, "\\Seen");
        return $status;
    }

}
?>
