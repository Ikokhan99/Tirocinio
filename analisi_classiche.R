# Title     : Translate Data for classic analysis
# Objective : Translate data to svg from mysql
# Created by: Maur
# Created on: 11/02/2021


#install.packages("RMySQL")
library(RMySQL)

#mydb = dbConnect(MySQL(), user='user', password='password', dbname='database_name', host='host')
mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')
query <- "select u.id as ID,HEX(u.sex) as sex, HEX(u.sexid) as sexid,u.age,u.time, SUM(a.power) as Power, SUM(a.sexual) as sexual, SUM(a.experience) as Experience, SUM(a.intention) as intention
          from (user as u inner join choice as c on u.id = c.user_id) INNER JOIN avatar as a on c.chosen = a.id
          where HEX(u.trusted = 0)
          GROUP BY (u.id)"
rs <- dbSendQuery(mydb, query)
data1 <- fetch(rs, n=-1)
data1
query <- "select u.id as ID,HEX(u.sex) as sex,HEX(u.sexid) as sexid,u.age,u.time, SUM(a.power) as Power, SUM(a.sexual) as sexual, SUM(a.experience) as Experience, SUM(a.intention) as intention
          from (user as u inner join choice as c on u.id = c.user_id) INNER JOIN avatar as a on c.other = a.id
          where u.trusted = 0
          GROUP BY (u.id)"
rs <- dbSendQuery(mydb, query)
data2 <- fetch(rs, n=-1)
data2

query <- "select u.id as ID,q.playtime,q.fav_gens,g.title as GAME1_TITLE,g.sexism as GAME1_SEXISM,g.violence as GAME1_VIOLENCE,g.realism1 as GAME1_GRAPHIC_REALISM ,g.realism2 as GAME1_MECHANICS_REALISM
          from (user as u inner join q2 as q on u.id = q.user_id) INNER JOIN game as g on q.game1 = g.id
          where u.trusted = 0 "
rs <- dbSendQuery(mydb, query)
dataQ21 <- fetch(rs, n=-1)
query <- "select u.id as ID,g.id,g.title as GAME2_TITLE,g.sexism as GAME2_SEXISM,g.violence as GAME2_VIOLENCE,g.realism1 as GAME2_GRAPHIC_REALISM ,g.realism2 as GAME2_MECHANICS_REALISM
          from (user as u inner join q2 as q on u.id = q.user_id) INNER JOIN game as g on q.game2 = g.id
          where u.trusted = 0"
rs <- dbSendQuery(mydb, query)
dataQ22 <- fetch(rs, n=-1)
dataQ2 <- merge(dataQ21,dataQ22,by="ID")
#dataQ2

query <- "select u.id as ID, q.question1 as Q3_1, q.question2 as Q3_2, q.question3 as Q3_3, q.question4 as Q3_4, q.question5 as Q3_5, q.question6 as Q3_6, q.question7 as Q3_7, q.question8 as Q3_8, q.question9 as Q3_9, q.question10 as Q3_10, q.question11 as Q3_11, q.question12 as Q3_12, q.question13 as Q3_13, q.question14 as Q3_14, q.question15 as Q3_15, q.question16 as Q3_16, q.question17 as Q3_17, q.question18 as Q3_18, q.question19 as Q3_19, q.question20 as Q3_20, q.question21 as Q3_21, q.question22 as Q3_22
          from user as u inner join Q3 as q on u.id = q.user_id
          where u.trusted = 0"
rs <- dbSendQuery(mydb, query)
dataQ3 <- fetch(rs, n=-1)

query <- "select u.id as ID, q.question1 as Q4_1, q.question2 as Q4_2, q.question3 as Q4_3, q.question4 as Q4_4, q.question5 as Q4_5, q.question6 as Q4_6, q.question7 as Q4_7, q.question8 as Q4_8, q.question9 as Q4_9, q.question10  as Q4_10
          from user as u inner join Q4 as q on u.id = q.user_id
          where u.trusted = 0"
rs <- dbSendQuery(mydb, query)
dataQ4 <- fetch(rs, n=-1)

query <- "select u.id as ID, q.question1 as Q5_1, q.question2  as Q5_2, q.question3 as Q5_3, q.question4 as Q5_4, q.question5 as Q5_5, q.question6 as Q5_6, q.question7 as Q5_7, q.question8 as Q5_8, q.question9 as Q5_9, q.question10 as Q5_10
          from user as u inner join Q5 as q on u.id = q.user_id
          where u.trusted = 0"
rs <- dbSendQuery(mydb, query)
dataQ5 <- fetch(rs, n=-1)

#merge avatars
data <- data1[,c(6,7,8,9)] - data2[,c(6,7,8,9)]
total <- cbind(data1[,c(1,2,3,4,5)],data)#,by="ID")
total

#merge q2
total <- merge(total,dataQ2,by="ID")
#total

#merge q3
total <- merge(total,dataQ3,by="ID")
#total

#merge q4
total <- merge(total,dataQ4,by="ID")
#total

#merge q5
total <- merge(total,dataQ5,by="ID")
#total


write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\analisi_classiche.csv")


ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))
rm(list=ls())