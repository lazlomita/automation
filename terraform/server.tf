# tell me where are you working on
provider "digitalocean" {
  token = "0087053d7d9a874d94da5b9417d32af7d8b1d5bbb0ae423b0ad3c41bf58b3818"
}

# what's your key
resource "digitalocean_ssh_key" "key" {
  name = "My own key"
  public_key = "${file("~/.ssh/id_rsa.pub")}"
}

# launch the server, 'cause reasons
resource "digitalocean_droplet" "web" {
  image  = "ubuntu-17-10-x64"
  name   = "web"
  region = "nyc3"
  size   = "1gb"
  ssh_keys = ["${digitalocean_ssh_key.key.id}"]
}

# output the public ip
output "public_ip" {
  value = "${digitalocean_droplet.web.ipv4_address}"
}
