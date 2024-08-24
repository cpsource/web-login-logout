Setting up a CSP (content security policy) for your web site for ubuntu linux with apache2 and a chrome browser.

Let's assume our CSP exception logger will be our website. We will
create a subdomain of the form csp.<yoursite>.org and add a web page
there to take care of the logging.

We'll liberally use PHP, so make sure your apache2 supports it, with a
web page called phpinfo.php of the form:

  ```<?php
    phpinfo();
  ```?>

Point chrome at this and you should get a long printout of configuration data.

It's a good idea to save off your ssl keys. Do so with the script:

  ```
      sudo ./save-key.sh
  ````
  
Next, make sure your DNS records support the new subdomain. You must have an
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

I used a 'free' certificate from zerossl and I don't recommend them. First
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

Note: Before I could run this, I had to run ./cleanup.sh.

References

https://developer.chrome.com/docs/lighthouse/best-practices/csp-xss/?utm_source=lighthouse&utm_medium=devtools

https://chatgpt.com (Really handy for writing scripts! I estimate I am 20 times more productive.)
 
