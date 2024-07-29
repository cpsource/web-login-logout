# web-login-logout
We use and evaluate ChatGPT to create login and logout web pages using bootstrap and PHP

I've been looking at ways to build a modern web site easily. I took a look at Wappler. It's at least $50/month
and rather complicated. The example I followed was an approximately 40 hour course on doing login and logout.

Could it be done faster and cheaper?

The answer is yes. I used ChatGPT4, for $20/month, and within an hour, I had more or less working login and
logout pages. I saved 39 hours of work, AND, $30/month.

The login page writes the database at the end, and it should not. I didn't ask Chat to delete it, as I got rather bored, and I've proved my point anyway.

The files are
  login.php - main login script
  logout.php - main logout script
  create_db.php - the database schema

Observations
1. Chat handles the muck associated with bootstrap, sessions, and cookies. Who cares what an mt-5 is, or whatever.
2. Chat picked bootstrap 4. Seemed good enough. I don't know if it can program bootstrap 5.
3. If I were to continue with it, i'd have to cleanup the database write at the end of login.php
4. I'd have to add a 'Register User' web page. 
5. I'd have to add a 'Login Admin' web page.
6. The login page should be immune from various attacks. Blank hidden fields are included in the
   post to block login scripts, as well as using htmlspecialchars to block code insertion. 

Notes:
1. You should create the database directory yourself instead of the script. Do so as follows:
     cd /var/www
     sudo mkdir databases
     sudo chown www-data:www-data data

Conclusion:
1. ChatGPT4 is an excelent, cheaper, and time-saving way to create login and logout pages.

