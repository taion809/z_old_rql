#!/bin/sh
set -ex

wget -L "https://protobuf.googlecode.com/files/protobuf-2.5.0.zip" -O "protobuf-2.5.0.zip"
unzip protobuf-2.5.0.zip
cd protobuf-2.5.0 && ./configure --prefix=/usr && make
cd $HOME
