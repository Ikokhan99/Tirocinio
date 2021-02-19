# Title     : Translate Data for mixed choice analysis
# Objective : Translate data to csv from mysql
# Created by: Maur
# Created on: 17/02/2021
#aggiungere gender partecipante e caratteristiche avatar, separare i file per sesso del partecipante + tempo di reazione medio
#install.packages("RMySQL")
library(RMySQL)
#mydb = dbConnect(MySQL(), user='user', password='password', dbname='database_name', host='host')
mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')

foo <- function (sex = 0){

  query <- paste0("select u.id as USER, u.sexid as GENDER
            from (user as u)
            where sex = ",sex)
  rs <- dbSendQuery(mydb, query)
  users <- fetch(rs, n=-1)
  total <- users
  u <- users$USER

  for(i in seq_along(u)){
    stuff <- matrix(rep(c(u[i],users$GENDER[i]),10),10,2,TRUE)
    stuff <- data.frame(USER = stuff[,1], GENDER = stuff[,2])
    #print(stuff)
    #print(total)
    total <- rbind(total,stuff)
  }

  total <- total[seq_along(u) * -1,]
  #writeLines("TOTAL:")
  #print(total)
  #writeLines("------------------")

  av <- data.frame()

  for(user in u)
  {

    # writeLines("USER:")
    # print(user)
    # writeLines("------------------")

    query <- paste0("select c.other
            from (user as u INNER JOIN choice as c on c.user_id = u.id)
            where (u.id='",user,"') AND (c.type = 3)
            GROUP BY c.other")
    rs <- dbSendQuery(mydb, query)
    discarded <- fetch(rs, n=-1)
    #print(discarded)
    query <- paste0("select c.chosen
            from (user as u INNER JOIN choice as c on c.user_id = u.id)
            where (u.id='",user,"') AND (c.type = 3)
            GROUP BY c.chosen")
    rs <- dbSendQuery(mydb, query)
    chosen <- fetch(rs, n=-1)
    #print(chosen)
    avatars <- unique(c(chosen$chosen,discarded$other))
    #print(user)
    # print(avatars)


    count <- array()
    for(avatar in avatars){
      query <- paste0("select count(c.chosen) as co
            from (user as u INNER JOIN choice as c on c.user_id = u.id)
            where (sex = ",sex,") AND (u.id='",user,"') AND (c.type = 3) AND (c.chosen = ",avatar,")")
      rs <- dbSendQuery(mydb, query)
      co <- fetch(rs, n=-1)
      count <- c(count,co$co)

    }
    #writeLines("count:")
    #print(count)
    #writeLines("------------------")

    temp <- cbind(avatars,count[-1])

    #writeLines("temp:")
    #print(temp)
    #writeLines("------------------")
    av <- rbind(av,temp)
    #writeLines("AV:")
    #print(av)
    #writeLines("------------------")

  }
  total <- cbind(total,av)
  names(total)[4] <- paste0("COUNT")

  temp <- array(dim = 5)
  #----------------- avatar chars ---------
  for(avatar in total$avatars){
    query <- paste0("select HEX(intention) as intention, HEX(power) as power, HEX(sexual) as sexualization, HEX(experience) as experience, HEX(sex) as sex
            from avatar
            where id = ",avatar)
    rs <- dbSendQuery(mydb, query)
    co <- fetch(rs, n=-1)
    temp <- rbind(temp,co)
  }

  #writeLines("TEMP:")
  #print(temp)
  #writeLines("------------------")

  total <- cbind(total, temp[-1,])

  #-------------translate------------------
  total$power <- ifelse(total$power == 1, "powerful", "not powerful" )
  total$sexualization <- ifelse(total$sexualization == 1, "sexualized", "not sexualized" )
  total$experience <- ifelse(total$experience == 1, "experienced", "unexperienced" )
  total$intention <- ifelse(total$intention == 1, "bad", "good" )
  total$sex <- ifelse(total$sex == 1, "female", "male" )

  names(total)[9] <- paste0("AV_sex")

  #writeLines("TOTAL:")
  #print(total)
  #writeLines("------------------")

  if(sex == 0){
    write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\analisi_miste_male.csv")
  } else {
    write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\analisi_miste_female.csv")
  }

}
#microbenchmark(foo(), times = 200)

#ptm <- proc.time()

foo(0)
foo(1)

writeLines("Closing...")
ile <- length(dbListConnections(MySQL())  )
lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
cat(sprintf("%s connection(s) closed.\n", ile))

#proc.time() - ptm
rm(list=ls())