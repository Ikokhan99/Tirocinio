# Title     : TODO
# Objective : TODO
# Created by: Maur
# Created on: 05/03/2021

dir <- "C:/xampp/htdocs/tirocinio/"

setwd(dir)
source("translate_functions.R")


#ConjountAnalysis(MALE)
ConjountAnalysis(FEMALE)

#AnalisiClassiche(MALE)
AnalisiClassiche(FEMALE)

#AnalisiMiste(MALE)
AnalisiMiste(FEMALE)


#microbenchmark(foo(), times = 200)

ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))
rm(list=ls())