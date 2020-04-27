#!/bin/bash

# For volume mapping use: -v $TOOLPATH/src:/var/www/html

echo "Checking for running tool..."
if [ "$(docker ps -aq -f name=tx-tool)" ]; then
    /bin/bash ./stop.sh
fi

TOOLPATH=$( dirname "$PWD" )
echo $TOOLPATH
echo "Building web tool..." 
docker build -t tx-tool $TOOLPATH && docker run --name=tx-tool -d -p 80:80 3000:3000 tx-tool
echo "Done!"
