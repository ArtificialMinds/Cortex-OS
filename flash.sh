#!/usr/bin/env bash
set -e
pv cortex-os.img.xz | xzcat | dd of=$1
