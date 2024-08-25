#!/bin/bash
wget https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
openssl dgst -sha384 -binary bootstrap.min.css | openssl base64 -A
