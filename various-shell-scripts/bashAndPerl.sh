#!/bin/bash

echo "This is Bash code"

# Using a here document to run Perl code
perl <<'END_PERL'
print "Hello from Perl\n";
END_PERL

echo "Back to Bash code"

