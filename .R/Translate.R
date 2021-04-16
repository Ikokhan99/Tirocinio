# Title     : TODO
# Objective : TODO
# Created by: Maur
# Created on: 05/03/2021

dir <- "C:/xampp/htdocs/avatar/.R"

setwd(dir)
source("translate_functions.R")

checkUsers(MALE)
checkUsers(FEMALE)
writeLines("check done")
ConjountAnalysis(MALE)
ConjountAnalysis(FEMALE)
writeLines("conjount done")
AnalisiClassiche(MALE)
AnalisiClassiche(FEMALE)
writeLines("classical done")
AnalisiMiste(MALE)
AnalisiMiste(FEMALE)
writeLines("mixed done")

#microbenchmark(foo(), times = 200)

ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))
rm(list=ls())