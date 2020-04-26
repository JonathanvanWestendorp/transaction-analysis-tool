#!/bin/bash

echo "Checking for running tool..."
if [ "$(docker ps -q -f name=tx-tool)" ]; then
    /bin/bash ./stop.sh
fi

TOOLPATH=$( dirname "$PWD" )

echo "Building web tool..." 
docker build -t tx-tool . && docker run --name=tx-tool -d --rm -v $TOOLPATH/src:/var/www/html -p 80:80 tx-tool
echo "Done!"
