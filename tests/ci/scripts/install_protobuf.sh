#!/bin/sh
set -ex

wget "https://code.google.com/p/protobuf/downloads/detail?name=protobuf-2.5.0.zip&can=2&q=" -O "protobuf-2.5.0.zip"
unzip protobuf-2.5.0.zip
cd protobuf-2.5.0 && ./configure --prefix=/usr && make && sudo make install
cd $HOME
