These two php files will be part of the register page. index.php is a test page and
process.php takes the data from the form, converts it to xml, then encrypts that
into a hex string which it then displays.

We do this because once the user receives email as part of the registration
process, they will return this string to us to complete the registration.

We will then decrpt and unpack, and use that to complete the registration in our users
database. This code is not shown.

