#!/usr/bin/env bash
set -e

IMG=$(cat current-image.txt)
pv $IMG.xz | xzcat | dd of=$1
