#!/bin/bash

# Check if the URL argument is provided
if [ -z "$1" ]; then
    echo "Error: No URL provided."
    echo "Usage: $0 <bootstrap-url>"
    exit 1
fi

# Assign the URL from the command line argument
URL=$1

# Create a temporary file
TEMP_FILE=$(mktemp)

# Download the Bootstrap CSS file into the temporary file
wget $URL -O $TEMP_FILE

# Check if the download was successful
if [ $? -ne 0 ]; then
    echo "Error: Failed to download the file from $URL."
    # Remove the temporary file in case of failure
    rm -f $TEMP_FILE
    exit 1
fi

# Generate the SHA-384 hash and encode it in base64
INTEGRITY_HASH=$(openssl dgst -sha384 -binary $TEMP_FILE | openssl base64 -A)

# Display the SRI hash
echo "Integrity (SHA-384): sha384-$INTEGRITY_HASH"

# Remove the temporary file
rm -f $TEMP_FILE

