# Evaluate aws.amazon.com

Amazon offered a ubuntu linux node for about $5.00 a month with full ssh access, so I gave it a try.

This directory contains some of what I've done with it.

## Security

 The first thing I did was install
 
    * https://ubuntu.com/aws/pro

It provides an automatic update, including security patches. I was free for me.

## Web Server

I pulled in apache2 via 'sudo apt install apache2' and it works reasonably.

## Getting a certificate to use https://

I applied for and received a security certificate from aws, BUT, it would not allow me to downlaod
it. What a bust.

Next, I went to zeroSSL and got a free certificate, but it's only good for 3 months and you have
to renew manually. Yuck.

Finally, I ended up at https://certbot.eff.org/. They offer a free certificate good for 60 days, but
they have an update untility that keeps yours current. Once the zeroSSL expires, I'll give this
one a try.

## Trying out aws sendmail

See https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html for install
instructions.

See https://docs.aws.amazon.com/ses/latest/dg/send-an-email-using-sdk-programmatically.html#send-an-email-using-sdk-programmatically-examples

See https://docs.aws.amazon.com/ses/latest/dg/using-configuration-sets.html

cacert.pem is from https://curl.se/docs/caextract.html

## Currently Stuck

PHP Fatal error:  Uncaught Aws\Exception\CredentialsException: Cannot read credentials from /home/ubuntu/.aws/credentials in /home/ubuntu/vendor/aws/aws-sdk-php/src/Credentials/CredentialProvider.php:394

Where would I get that from ?

I'm in a sandbox too. Somewhere I read that I need to verify the to address, but where was that again?

Amazon directions tend to help to a point, then leave you there. Then, you have to wander aimlessly around.

What is an IAM user?

## Compare with fastMail

It took about two hours to get fastMail connected. I'm already four hours into the aws with nothing
to show for it yet. They should sit somebody down who is unfamiliar with their systems and watch
where they get stuck. Then FIX IT!

## Finally working

I had to sudo apt-get install php-xml -y
and edit the passwords into the php scrpt. I need to move them to .aws.

~/.aws/credentials is just

  * [default]
  * aws_access_key_id = your-key
  * aws_secret_access_key = your-secret

Note: The script amazon-ses-sample.php if called directly from php, however
      it will not work if the file is called as a web page.
      
## Summary

Seting up aws mailer is not for the timid. I finially got the task done in about 9 hours.
