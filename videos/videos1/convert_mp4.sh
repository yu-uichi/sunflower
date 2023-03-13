#!/bin/sh

files="./*/*"

for filepath in $files
do
	nkf -w --overwrite ./*
done


echo 'Convert all finished!'
