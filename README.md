
simple php script for check if ip already banned via shell_exec like this: 
iptables -L -n | egrep "142\.250\.68\.46\s+0\.0\.0\.0\/0\s+reject"

and custom actions in Fail2Ban

# Fail2ban, make custom actions on fail2ban events, and example of checking if already banned in some PHP script.
for create custom action: 
1. copy file: cp dummy.conf newAction1.conf 
2. define new vars in newAction.conf, like this: actionban = /usr/bin/perl /var/tmp/f2b.php ip=<ip> 
3. edit jail.local and add in action like this : action=....some actions...... newAction1
