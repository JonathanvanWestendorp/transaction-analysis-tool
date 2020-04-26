#!/bin/bash

echo "Checking for running tool..."
if [ "$(docker ps -q -f name=tx-tool)" ]; then
    /bin/bash ./stop.sh
fi

TOOLPATH=$( dirname "$PWD" )
echo $TOOLPATH
echo "Building web tool..." 
docker build -t tx-tool $TOOLPATH && docker run --name=tx-tool -d -v $TOOLPATH/src:/var/www/html -p 80:80 tx-tool
echo "Done!"
