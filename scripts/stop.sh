#!/bin/bash

echo "Removing leftover instances and images"
docker stop tx-tool &&  docker rm tx-tool && docker rmi tx-tool
echo "Done!"
