#!/bin/sh

php bin/console doctrine:generate:entity -n \
  --entity AppBundle:Test \
  --fields="title:string(length=100 nullable=true unique=false) \
    body:text \
    ranking:decimal(precision=10 scale=0)"
