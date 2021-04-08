# Title     : TODO
# Objective : TODO
# Created by: Maur
# Created on: 24/03/2021
library(RMySQL)
library(DBI)

MALE <- 0
FEMALE <- 1

mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')
dir <- "C:/xampp/htdocs/avatar/"

setwd(dir)
source("translate_functions.R")
checkUsers(MALE)
checkUsers(FEMALE)

ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))
rm(list=ls())