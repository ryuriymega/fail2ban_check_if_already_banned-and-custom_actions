<?php

list($key, $val) = explode('=',$argv[1]);
var_dump(array($key=$val));
$ipAddr=$val;
if(preg_match("/^\d+\.\d+.\d+.\d+$/s",$ipAddr)){
        echo "ipAdd correct:".$ipAddr."\n";
        echo "check if already banned\n";

        $foundF2BanStatus=shell_exec('iptables -L -n | egrep "'.str_replace(".","\.",$ipAddr).'\s+0\.0\.0\.0\/0\s+reject"');

        echo "\n-----------------\n".$foundF2BanStatus."\n=======".$ipAddr."============\n###################\n";
        //exit;

        if(stristr($foundF2BanStatus, $ipAddr)===FALSE){
                
                shell_exec("fail2ban-client set postfix-sasl banip ".$ipAddr);
                shell_exec("fail2ban-client set postfix-rbl banip ".$ipAddr);
                shell_exec("fail2ban-client set postfix banip ".$ipAddr);
                shell_exec("fail2ban-client set squid banip ".$ipAddr);
                shell_exec("fail2ban-client set asterisk banip ".$ipAddr);
                shell_exec("fail2ban-client set sshd banip ".$ipAddr);
                shell_exec("fail2ban-client set directadmin banip ".$ipAddr);
                shell_exec("fail2ban-client set mongodb-auth banip ".$ipAddr);
                shell_exec("fail2ban-client set freeswitch banip ".$ipAddr);
                
                mail("your@mail.com","f2b, Fail2Ban","\n=========".$ipAddr."================\n".
                            "set to BAN :\n".shell_exec('iptables -L -n | egrep "'.str_replace(".","\.",$ipAddr).'\s+"').
                        "\n----------------\n---------------\n");
          
          ////////////////////////////////////
          //..... any other actions if needed
          ////////////////////////////////////
          
        }else{
                echo "already banned, exit";
                exit;
        }

}
?>
