#!/bin/sh
set -ex

wget "https://github.com/chobie/php-protocolbuffers/archive/master.zip" -O "php-protobuf.zip"
unzip php-protobuf.zip
cd php-protocolbuffers-master && phpize && ./configure --prefix=/usr && make && sudo make install
cd $HOME
echo 'extension=protocolbuffers.so' >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
