# Title     : Translate Data
# Objective : Translate data to svg from mysql
# Created by: Maur
# Created on: 11/02/2021


#install.packages("RMySQL")
library(RMySQL)

#mydb = dbConnect(MySQL(), user='user', password='password', dbname='database_name', host='host')
mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')
query <- "select u.id,u.sex,u.sexid,u.age,u.time, SUM(a.power) as Power, SUM(a.sexual) as sexual, SUM(a.experience) as Experience, SUM(a.intention) as intention
          from (user as u inner join choice as c on u.id = c.user_id) INNER JOIN avatar as a on c.chosen = a.id
          where u.trusted = 0"
rs <- dbSendQuery(mydb, query)
data1 <- fetch(rs, n=-1)
data1
query <- "select u.id,u.sex,u.sexid,u.age,u.time, SUM(a.power) as Power, SUM(a.sexual) as sexual, SUM(a.experience) as Experience, SUM(a.intention) as intention
          from (user as u inner join choice as c on u.id = c.user_id) INNER JOIN avatar as a on c.other = a.id
          where u.trusted = 0"
rs <- dbSendQuery(mydb, query)
data2 <- fetch(rs, n=-1)
data2

data <- data1[,c(6,7,8,9)] - data2[,c(6,7,8,9)]
total <- merge(data1[,c(1,2,3,4,5)],data)#,by="ID")
total

write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\ris_test.csv")