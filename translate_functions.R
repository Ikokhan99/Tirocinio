# Title     : Translate Data for analysis
# Objective : Translate data to csv from mysql
# Created by: DMMP
# Created on: 11/02/2021

#install.packages("RMySQL")
library(RMySQL)
library(DBI)

MALE <- 0
FEMALE <- 1

#mydb = dbConnect(MySQL(), user='user', password='password', dbname='database_name', host='host')
mydb <- dbConnect(MySQL(), user='root', password='', dbname='vaesdb', host='localhost')

ris_gens  <- function (gens="",first=TRUE){
  ris <- data.frame(GENS = c("Platform","FPS","TPS","Danmaku","BattleRoyale", "Fighting", "Brawlers", "Stealth", "Survival", "SurvivalHorror", "Metroidvania", "TextAdv", "GraphicAdv", "VisualNovel", "InteractiveMovie", "RealTime3Dadventure", "Roguelike", "MMO", "MMORPG", "ActionRPG","TacticalRPG", "JRPG", "FPPBRPG", "MonsterTamer", "SandboxRPG", "Sandbox", "OpenWorld", "ConstructionSim", "LifeSim", "VehicleSim", "DatingSim", "Eroge", "4x", "Artillery", "AutoBattler", "MOBA", "RTS", "RTT", "TBS", "Arcade","TowerDefense", "Sport", "Card", "Horror", "Party", "Typing", "Logic", "Puzzle", "Other"), VALUES = rep(0,49))

  i <- 0
  for(gen in ris$GENS){

    i<- i+1
    #DEBUG:
    #res <-ifelse(grepl(gen,gens, fixed = TRUE),1,0)
    #if(res == 0){
    #  writeLines(paste0(gen," was not found in ", gens))
    #} else {
    #  writeLines(paste0(gen," was found in ", gens))
    #}
    #ris$VALUES[i] <- res
    ris$VALUES[i]<- ifelse(grepl(gen,gens, fixed = TRUE),1,0)


  }
  ifelse(first,return(ris),return(ris$VALUES))
}

AnalisiClassiche <- function(sex = MALE){
  query <- paste0("select u.id as ID,HEX(u.sex) as sex, HEX(u.sexid) as sexid,u.age,u.time AS Total_Time
          from (user as u inner join choice as c on u.id = c.user_id) INNER JOIN avatar as a on c.chosen = a.id
          where u.sex = ",sex," AND (u.time != 0)
          GROUP BY (u.id)")
  rs <- dbSendQuery(mydb, query)
  data1 <- fetch(rs, n=-1)

  #time
  query <- paste0("select u.id as ID, sum(c.time) as time
          from (user as u inner join choice as c on u.id = c.user_id)
          where (c.type = 0) AND (u.sex = ",sex,") AND (u.time != 0)
          GROUP BY (u.id)")
  rs <- dbSendQuery(mydb, query)
  dataTIME1 <- fetch(rs, n=-1)
  #print(dataTIME1$time)
  #print("-------------")
  #print("     120      ")
  #print("      =       ")
  dataTIME1$time <- dataTIME1$time/120
  #print(dataTIME1$time)
  query <- paste0("select u.id as ID, sum(c.time) as time
          from (user as u inner join choice as c on u.id = c.user_id)
          where (c.type = 1) AND (u.sex = ",sex,") AND (u.time != 0)
          GROUP BY (u.id)")
  rs <- dbSendQuery(mydb, query)
  dataTIME2 <- fetch(rs, n=-1)
  dataTIME2$time <- dataTIME2$time/120
  query <- paste0("select u.id as ID, sum(c.time) as time
          from (user as u inner join choice as c on u.id = c.user_id)
          where (c.type = 3) AND (u.sex = ",sex,") AND (u.time != 0)
          GROUP BY (u.id)")
  rs <- dbSendQuery(mydb, query)
  dataTIME3 <- fetch(rs, n=-1)
  dataTIME3$time <- dataTIME3$time/25
  #q2
  query <- paste0("select u.id as ID,q.playtime,g.title as GAME1_TITLE,g.sexism as GAME1_SEXISM,g.violence as GAME1_VIOLENCE,g.realism1 as GAME1_GRAPHIC_REALISM ,g.realism2 as GAME1_MECHANICS_REALISM
          from (user as u inner join q2 as q on u.id = q.user_id) INNER JOIN game as g on q.game1 = g.id
          where (u.sex = ",sex,") AND (u.time != 0)")
  rs <- dbSendQuery(mydb, query)
  dataQ21 <- fetch(rs, n=-1)
  query <- paste0("select u.id as ID,g.id,g.title as GAME2_TITLE,g.sexism as GAME2_SEXISM,g.violence as GAME2_VIOLENCE,g.realism1 as GAME2_GRAPHIC_REALISM ,g.realism2 as GAME2_MECHANICS_REALISM
          from (user as u inner join q2 as q on u.id = q.user_id) INNER JOIN game as g on q.game2 = g.id
          where (u.sex = ",sex,") AND (u.time != 0)")
  rs <- dbSendQuery(mydb, query)
  dataQ22 <- fetch(rs, n=-1)
  dataQ2 <- merge(dataQ21,dataQ22,by="ID")
  #dataQ2

  query <- paste0("select u.id as ID, q.fav_gens
          from user as u inner join Q2 as q on u.id = q.user_id
          where (u.sex = ",sex,") AND (u.time != 0)")
  rs <- dbSendQuery(mydb, query)
  dataGENS <- fetch(rs, n=-1)

  ris <- rep(0,49)
  for(i in seq_along(dataGENS$ID)){
    if(i == 1){
      ris <- cbind(ris,ris_gens(dataGENS$fav_gens[i]))
    } else {
      ris <- cbind(ris,ris_gens(dataGENS$fav_gens[i],FALSE))

    }
  }



  ris <- ris[-1]
  gens <- ris$GENS
  values <- ris[-1]
  rm(ris)


  #q3
  query <- paste0("select u.id as ID, q.question1 as Q3_1, q.question2 as Q3_2, q.question3 as Q3_3, q.question4 as Q3_4, q.question5 as Q3_5, q.question6 as Q3_6, q.question7 as Q3_7, q.question8 as Q3_8, q.question9 as Q3_9, q.question10 as Q3_10, q.question11 as Q3_11, q.question12 as Q3_12, q.question13 as Q3_13, q.question14 as Q3_14, q.question15 as Q3_15, q.question16 as Q3_16, q.question17 as Q3_17, q.question18 as Q3_18, q.question19 as Q3_19, q.question20 as Q3_20, q.question21 as Q3_21, q.question22 as Q3_22
          from user as u inner join Q3 as q on u.id = q.user_id
          where (u.sex = ",sex,") AND (u.time != 0)")
  rs <- dbSendQuery(mydb, query)
  dataQ3 <- fetch(rs, n=-1)
  #q4
  query <- paste0("select u.id as ID, q.question1 as Q4_1, q.question2 as Q4_2, q.question3 as Q4_3, q.question4 as Q4_4, q.question5 as Q4_5, q.question6 as Q4_6, q.question7 as Q4_7, q.question8 as Q4_8, q.question9 as Q4_9, q.question10  as Q4_10
          from user as u inner join Q4 as q on u.id = q.user_id
          where (u.sex = ",sex,") AND (u.time != 0)")
  rs <- dbSendQuery(mydb, query)
  dataQ4 <- fetch(rs, n=-1)
  #q5
  query <- paste0("select u.id as ID, q.question1 as Q5_1, q.question2  as Q5_2, q.question3 as Q5_3, q.question4 as Q5_4, q.question5 as Q5_5, q.question6 as Q5_6, q.question7 as Q5_7, q.question8 as Q5_8, q.question9 as Q5_9, q.question10 as Q5_10
          from user as u inner join Q5 as q on u.id = q.user_id
          where (u.sex = ",sex,") AND (u.time != 0)")
  rs <- dbSendQuery(mydb, query)
  dataQ5 <- fetch(rs, n=-1)
  #stop()
  #merge times
  total <- cbind(data1[,c(1,2,3,4,5)],dataTIME1$time)
  names(total)[5] <- paste0("TOTAL_TIME(s)")
  names(total)[6] <- paste0("TR_MALE_ONLY(ms)")
  total <- cbind(total,dataTIME2$time)
  names(total)[7] <- paste0("TR_FEMALE_ONLY(ms)")
  total <- cbind(total,dataTIME3$time)
  names(total)[8] <- paste0("TR_MIX(ms)")
  #merge favgens
  i <- 8
  values <- as.data.frame(t(as.matrix(values)))
  for(gen in gens){
    i <- i+1
    total[i] <- values[,i-8]
    names(total)[i] <- gen
  }
  #total

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

  #stop()
  if(sex == 0){
    write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\analisi_classiche_male.csv")
  } else {
    write.csv(total,"C:\\xampp\\htdocs\\tirocinio\\analisi_classiche_female.csv")
  }
}

AnalisiMiste <- function (sex = MALE){
  query <- paste0("select u.id as USER, u.sexid as GENDER
            from (user as u)
            where (sex = ",sex,") AND (u.time != 0)")
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

ConjountAnalysis <- function (sex = MALE){
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

  upt <- data.frame(total = {0} )

  query <- paste0("select id
              from user
              where (sex = ",sex,") AND (time != 0)")
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