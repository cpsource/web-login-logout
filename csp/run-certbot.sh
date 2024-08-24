#!/bin/bash
sudo certbot --apache --server https://acme-v02.api.letsencrypt.org/directory --preferred-challenges dns -d '*.<yoursite>.org' -d <yoursite>.org
