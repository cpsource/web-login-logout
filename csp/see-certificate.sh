#!/bin/bash
echo "SSL Certificate information is kept here:";
echo "  /etc/ssl/ca-bundlke.crt";
echo "  /etc/ssl/certificate.crt";
echo "  /etc/ssl/private/private.key";
echo ""
echo "Now displaying certificate.crt:"
echo ""
openssl x509 -in /etc/ssl/certificate.crt -text -noout
