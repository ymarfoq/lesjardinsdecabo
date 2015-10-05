
sqlite3 -header -separator , base.bdd "select * from reservation;">>reservation.csv

sqlite3 -header -separator , base.bdd "select * from photo;">>photo.csv

sqlite3 -header -separator , base.bdd "select * from partenaires;">>partenaires.csv

sqlite3 -header -separator , base.bdd "select * from commentaires;">>forum.csv

sqlite3 -header -separator , base.bdd "select * from messages;">>messages.csv

