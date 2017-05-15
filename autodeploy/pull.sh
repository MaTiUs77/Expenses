#!/bin/sh

ROUTE_TO_GIT_PROJECT="./../"
LOG="./deploy.log"
NOW=$(date +"%Y-%m-%d-%H%M%S")

## Start script:
echo "
--------------------------------------------------------
NEW DEPLOYMENT: $NOW
" >> $LOG
cd $ROUTE_TO_GIT_PROJECT >> $LOG
git checkout master >> $LOG
git clean -df >> $LOG
git checkout -- . >> $LOG
git pull >> $LOG

echo "End Deploy." >> $LOG