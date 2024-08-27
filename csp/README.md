I setup a strict CSP (content security policy) for one of my web sites. These are my notes
on the process. They will SAVE YOU a great deal of time if you've never done it
before.

I used ubuntu linux with apache2 and a chrome browser.

Let's assume our CSP exception logger will be our website. We will
create a subdomain of the form csp.<yoursite>.org and add a web page
there to take care of the logging.

We'll liberally use PHP, so make sure your apache2 supports it, with a
web page called phpinfo.php of the form:

  ```<?php
    phpinfo();
    />
  ```

Point chrome at this and you should get a long printout of configuration data, which, for the
most part, you can ignore.

It's a good idea to save off your old ssl keys. Do so with the script:

  ```
      sudo ./save-key.sh
  ````
  
Make sure your DNS records support the new subdomain. You must have an
entry of the form:

  ```
	*.<yoursite>.org A <your ipv4 address>
	*.<yoursite>.org AAAA <your ipv6 address>
  ```

Next, check that your ssl certificate for port 443 allows the subdomain.
To help, run ./see-certificate.ssh. The output should have something of the
form:

  ```
	*.<yoursite>.org
  ```

For a while, I used a 'free' certificate from zerossl and I don't recommend them. First
the certificate is good for only three months, and two, it did not include
support for my subdomain.

Now, create a VirtualHost for ports 80 and 443 as follows.
Open file /etc/apache2/sites-enabled/000-default.conf and duplicate the
<Virtual Host> that's there. IN THE TOP ONE (because the first matching one wins), modify the first three lines
as follows:

  ```
  <VirtualHost csp.yoursite.org:80>
  	         ServerName csp.yoursite.org
    		 DocumentRoot /var/www/csp
  ...

  ```

Edit /etc/apache2/sites-enabled/default-ssl.conf in a similar way.
Use:

  ```

  <VirtualHost csp.yoursite.org:443>
  	         ServerName csp.yoursite.org
    		 DocumentRoot /var/www/csp
  ...

  ```

I've included 000-default.conf and default-ssl.conf that I  use, so you can see what
I did.

I've also included dot-gitignore and dot-htaccess as examples ONLY. These should be edited down to the '.' form of the
file and placed in /var/www/html. For example, cp dot-htaccess /var/www/html/.htaccess.

Restart apache2 via the command: sudo systemctl restart apache2.

Install your homepage for csp. To make it easy, I've included the script as
follows:

  ```
	sudo ./install-index.sh

  ```

Now test that these two url's display properly from the chrome browser.

  ```
	https://csp.yoursite.org
	- and -
	http://csp.yoursite.org
  ```

You should see:

  ```
  CSP Report Listener

  This page is used to receive and log CSP reports.
  ```

Audit your site

  Google makes a handy CSP Evaluator web page at https://csp-evaluator.withgoogle.com/ Enter your web sites's
  homepage in there and and press CHECK CSP. It will give you a report.

  And, somewhat unrelated, you might want to run Chrome's built-in web page evaluator. Bring up your
  home page, right click on it, select Inspect, then look to the top right window and just above it,
  one of the menu items will be Lighthouse. Click on that.

Use 'Lets Encrypt' (https://letsencrypt.org/getting-started/) to get and manage your ssl certificates.

Note: It's not so easy to get domains PLUS subdomains up. If you follow the simple instructions
on the web site, it won't work. Be sure to edit the TXT file into your DNS record !

Note: Before I could run this, I had to run ./cleanup.sh.
Note: Run sudo ./run-certbot.sh.

Note: I've included a copy of the first entry in my 000-default.conf and default-ssl.conf for subdomain csp. Replace <yoursite> with your site name.

To get help with Lets Encrypt, see https://community.letsencrypt.org/

## Your Work Flow

If you first turn on CSP, the output can be overwhelming. Here's some tips.

1. Copy a csp-error.log entry, ask ChatGPT4 to explain it, then paste it in. Then go
fix that particular error.

2. And Chrome is a super resource. Bring up the web page in question, right click, and select 'Inspect'. 
On the right side, you will see a tab for 'console'. In the console, you will see all the CSP
exceptions listed. And, to help clarify the exceptions, cut and paste them into ChatGPT4 one at a time.

3. Once you understand the error, copy your code into the paste buffer, and ask ChatGPT4 to rewrite the
code to eleminate the exception.

## PHP vs JS

Which one is better? This seems to be an old feud, one that I won't settle. Some things can not be done with PHP, so do them in JS.

## References

https://developer.chrome.com/docs/lighthouse/best-practices/csp-xss/?utm_source=lighthouse&utm_medium=devtools

https://chatgpt.com (Really handy for writing scripts! I estimate I am 20 times more productive.)

https://community.letsencrypt.org/t/wildcard-subdomain-cert-doesnt-work-before-i-created-certs-for-main-domain-and-another-subdomains/78724/2

https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
 
