# Title     : Conjount analysis
# Objective : Translate experiment data to csv from mysql
# Created by: DMMP
# Created on: 13/02/2021


#install.packages("RMySQL")
library(RMySQL)
# library(Rcpp)

#mydb = dbConnect(MySQL(), user='user', password='password', dbname='database_name', host='host')
mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')
query <- "select a.id as AvatarId, HEX(a.intention) as Intention, HEX(a.power) as Power, HEX(a.sexual) as Sexual, HEX(a.experience) as Experience , HEX(a.sex) as Sex
          from avatar as a"
rs <- dbSendQuery(mydb, query)
avatars <- fetch(rs, n=-1)
# avatars

avatars$Power <- ifelse(avatars$Power == 1, "powerful", "not powerful" )
avatars$Sexual <- ifelse(avatars$Sexual == 1, "sexualized", "not sexualized" )
avatars$Experience <- ifelse(avatars$Experience == 1, "experienced", "unexperienced" )
avatars$Intention <- ifelse(avatars$Intention == 1, "bad", "good" )
avatars$Sex <- ifelse(avatars$Sex == 1, "female", "male" )

total <- avatars

i <- 1

upt <- data.frame(total = {0} )

foo <- function (total,sex = 0) {
    query <- paste0("select id
              from user
              where sex = ",sex)
    rs <- dbSendQuery(mydb, query)
    users <- fetch(rs, n=-1)
    users <- users$id

    for(id in users )
    {
      up <- array({0},1)
      for(avatar in avatars$AvatarId){
        # writeLines(paste0("DEBUG: working on user (",id,") -> avatar (",avatar,")"))

        query <- paste0("select count(c.id) as total
              from (user as u inner join choice as c on u.id = c.user_id) INNER JOIN avatar as a on a.id = c.chosen
              where (c.type != 3) AND (u.id = \'", id, "\') AND c.chosen = ", avatar)
        rs <- dbSendQuery(mydb, query)
        n <- fetch(rs, n=-1)
        up <- c(up,n$total)
      }
      up <- up[-1]
      upt <- cbind(upt,up)
    }

    upt <- upt[-1]
    #rename
    for(i in seq_along(upt)){
      names(upt)[i] <- paste0("S",i)
    }

    total <- cbind(total,upt)
    if(sex == 0){
      write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\conj_analysis_male.csv")
    } else {
      write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\conj_analysis_female.csv")
    }

}

#microbenchmark(foo(total = total), times = 200)

foo(total,0)
foo(total,1)

ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))

rm(list=ls())
