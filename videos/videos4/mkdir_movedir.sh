#!/bin/sh



files="*"
i=1;

for filepath in ${files}*.MTS
do
    mv $i.mp4 ./$i/
    i=$((i+1));

done


echo 'Convert all finished!'
