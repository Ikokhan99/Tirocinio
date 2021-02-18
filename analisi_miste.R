# Title     : Translate Data for mixed choice analysis
# Objective : Translate data to svg from mysql
# Created by: Maur
# Created on: 17/02/2021

#install.packages("RMySQL")
library(RMySQL)

#mydb = dbConnect(MySQL(), user='user', password='password', dbname='database_name', host='host')
mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')
query <- "select u.id as USER, c.chosen as AVATAR, count(c.chosen) as TIMES
          from (user as u inner join choice as c on u.id = c.user_id)
          where (c.type = 3)
          GROUP BY u.id,c.chosen
          ORDER BY u.id,c.chosen"
rs <- dbSendQuery(mydb, query)
data <- fetch(rs, n=-1)
data


write.csv(data,"C:\\xampp\\htdocs\\tirocinio\\analisi_miste.csv")


ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))
#rm(list=ls())