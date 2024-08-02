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

