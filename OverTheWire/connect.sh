#!/bin/bash -e

# Set the current game, for faster access
current=bandit

echo "The following games are available: "
ls ./games
echo -n "Choose game: [${current}] "
read game
if [[ ${game} = "" ]]; then
    game=${current}
fi

[[ ! -d ./games/${game} ]] && echo "The game '${game}' does not exist." && exit 1
echo "The following levels are available: "
ls -v ./games/${game}/secrets

# find highest available level
highest=$(ls ./games/${game}/secrets | sort -V | tail -n 1)
echo -n "Choose level: [${highest}] "
read level
if [[ ${level} = "" ]]; then
    level=${highest}
fi

echo Fetch password from file ${PWD}/${game}/secrets/${level}
password=$(cat ./games/${game}/secrets/${level})
echo The password is ${password}

host=$(cat ./games/${game}/host)
echo connecting to ${host}

sshpass -p ${password} ssh ${game}${level}@${host}
