# script used to install zsh in terminal
# meant to run in docker container under user = root

apt-get update
apt-get install nano
apt-get install -y zsh
apt-get install -y wget
wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh || true

# print out what do to next
RED='\033[0;31m'
NC='\033[0m'
printf "
${RED}================== do the following manually ==================${NC}

nano ~/.zshrc

[manually change theme] (suggested theme: wezm, steeef)

[source ~/.zshrc] or [docker exec -it image /bin/zsh]

${RED}===============================================================${NC}
"
