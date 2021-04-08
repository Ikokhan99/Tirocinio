# Title     : TODO
# Objective : TODO
# Created by: Maur
# Created on: 05/03/2021

dir <- "C:/xampp/htdocs/avatar/"

setwd(dir)
source("translate_functions.R")

checkUsers(MALE)
checkUsers(FEMALE)

ConjountAnalysis(MALE)
ConjountAnalysis(FEMALE)

AnalisiClassiche(MALE)
AnalisiClassiche(FEMALE)

AnalisiMiste(MALE)
AnalisiMiste(FEMALE)



query <- "select time
          from user
          where time != 0"
rs <- dbSendQuery(mydb, query)
tempi <- fetch(rs, n=-1)
boxplot(tempi/60)
#microbenchmark(foo(), times = 200)

ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))
rm(list=ls())