#!/bin/sh

files="./*/*"

for filepath in ${files}*.mov
do
#  echo ${filepath%.*}
#    rm upmovie1.mp4
#    ./ffmpeg/ffmpeg -i ${filepath%.*}.mov -f mp4 -vcodec mpeg4 -s 640*360 -strict -2 ${filepath%.*}.mp4

#    ./ffmpeg/ffmpeg -i ${filepath%.*}.mov -f mp4 -vcodec mpeg4 -strict -2 upmovie1.mp4
#    ./ffmpeg/ffmpeg -i ./upmovie1.mp4 -s 640*360 -strict -2 ${filepath%.*}.mp4

#    ffmpeg -i ${filepath%.*}.mp4 -s 720*480 -strict -2 ${filepath%.*}2.mp4
    ffmpeg -i ${filepath%.*}.mov -strict -2 -s 400*300 ${filepath%.*}.mp4

done


echo 'Convert all finished!'
