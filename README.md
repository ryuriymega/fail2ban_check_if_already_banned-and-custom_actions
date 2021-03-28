# fail2ban_check_if_already_banned-custom_actions
for create custom action: 1. copy file: cp dummy.conf newAction1.conf 2. define new vars in newAction.conf, like this: actionban = /usr/bin/perl /var/tmp/f2b.pl ip=&lt;ip> 3. edit jail.local and add in action like this : action=....some actions...... newAction1
