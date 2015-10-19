#!/usr/bin/env bash
set -e
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
OLDPWD=$PWD
cd $DIR

if [ "$#" -ne 1 ]; then
    echo "Error: "
	echo "Please pass in the path to SD card device as the first parameter"
	echo "e.g. ./install.sh /dev/sdX"
	exit 1
fi

echo "Imaging the will remove all contents from provided device: $1"
read -r -p "Are your sure you wish to image this device? [y/N]" response
case $response in
	[yY][eE][sS]|[yY])
		;;
	*)
		exit 1
		;;
esac

echo "Cleaning past builds..."
sleep 1
$DIR/clean.sh

echo "All builds are now clean."
echo "Downloading Debian build packages..."
sleep 1
$DIR/download.sh

echo "Build packages downloaded successfully."
echo "Building net installer distribution..."
sleep 1
$DIR/build.sh

echo "Net installer distribution built successfully."
echo "Creating image files..."
sleep 1
$DIR/image.sh

echo "Image files created successfully."
echo "Flashing image to device at $1 ..."
echo "PRESS CTRL+C NOW IF YOU WANT TO CANCEL!"
echo "CONTINUING WILL FORMAT THIS DEVICE!"
sleep 6
$DIR/flash.sh $1

cd $PWD

sync

echo ""
echo "Fash complete, please boot Cortex from your device to complete"
