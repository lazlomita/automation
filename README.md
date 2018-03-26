# Automation example


## Installation

```sh
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
apt-get update
apt-get install docker-ce -y

```

## Deploying a Docker Swarm cluster

```sh
# Using DigitalOcean metadata provider
public_ip=$(curl -s http://169.254.169.254/metadata/v1/interfaces/public/0/ipv4/address)
docker swarm init --advertise-addr $public_ip --listen-addr $public_ip

```
