#!E:\xampp\perl\bin\perl.exe
##
## Point web browser here, and voilla !
##   Sweet !
#
use strict;
use warnings;
use CGI qw(:standard);

print header();
print start_html("Hello World");
print h1("Hello, World!");
print p("This is a simple Perl CGI script generating a webpage.");
print end_html();
