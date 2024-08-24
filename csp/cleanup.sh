#!/bin/bash
sudo sh -c "sed -i.bak -e 's/^\(pref_challs.*\)tls-sni-01\(.*\)/\1http-01\2/g' /etc/letsencrypt/renewal/*; rm -f /etc/letsencrypt/renewal/*.bak"
