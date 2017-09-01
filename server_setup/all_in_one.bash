RED='\033[0;31m'
NC='\033[0m'
BLUE='\033[0;34m'

printf "${RED}================= install wget and nano ==================${NC} \n"
# install basic stuff
apt-get install wget
apt-get install nano

# MySQL-server
printf "${RED}========================== MySQL  ==========================${NC} \n"
apt-get install mysql-server
service mysql start
mysqladmin status
printf "${RED}================== MySQL session started ==================${NC} \n"
mysql < ./server_setup/new_database_with_topic.sql
printf "${RED}================ New quiz database created ================${NC} \n"