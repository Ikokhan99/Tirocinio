# Title     : TODO
# Objective : TODO
# Created by: DMMP
# Created on: 13/04/2021

#base config
dir <- "C:/xampp/htdocs/avatar/.R"
setwd(dir)
library(conjoint)

factors_file<-read.csv("conj_analysis_male.csv")[,-1]

#avatar profiles
aprof <- factors_file[,2:6]
#avatar preferences
aprefm <- factors_file[,-1:-6]
#avatar levels
alevn <- c(factors_file$Experience[1],factors_file$Experience[7],
           factors_file$Intention[1],factors_file$Intention[2],
           factors_file$Power[1],factors_file$Power[3],
           factors_file$Sex[1],factors_file$Sex[32],
           factors_file$Sexual[1],factors_file$Sexual[3])

caModel(y=aprefm, x=aprof)