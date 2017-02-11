# Simple WHOIS Lookup
Simple whois lookup by olback

Requirements:
* OS: Ubuntu/Debian
* Requires 'whois' to be installed on host
* PHP 5.5 or greater
* A HTTP Server (Preferably nginx)

### Send whois lookup results with a link
```index.php?q=example.com``` returns whois lookup for example.com.

## Want raw output, without any css?
* ```raw.php?myip``` returns your ip.
* ```raw.php?q=example.com``` returns whois lookup for example.com


All settings are located in ```res/settings.php```
