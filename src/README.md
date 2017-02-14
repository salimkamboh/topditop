# topditop

## Setting up Xdebug with MAMP

A good tutorial is on [remote](http://www.codechewing.com/library/debug-php-with-phpstorm-xdebug-mamp/) but still needs a few more steps.

Xdebug is by default in collision with brew php70 and its php70-xdebug and must use another port  

MAMP is considered a *remote* server in PhpStorm

Open php.ini from conf nested in bin directory, not from   
this works: `/Applications/MAMP/bin/php/php7.0.12/conf/php.ini`  
this doesn't: `/Applications/MAMP/conf/php7.0.12/php.ini`  
```
[xdebug]
zend_extension="/Applications/MAMP/bin/php/php7.0.12/lib/php/extensions/no-debug-non-zts-20151012/xdebug.so"
xdebug.remote_enable=1
xdebug.idekey=PHPSTORM
xdebug.remote_host=127.0.0.1
xdebug.remote_connect_back=1
xdebug.remote_port=9004
xdebug.remote_handler=dbgp
xdebug.remote_mode=req
xdebug.remote_autostart=0
```

### Setting php interpreter and xdebug in Phpstorm  
Open settings `cmd + ,`  
Go Languages & Frameworks > PHP and set two items
- Php language level to 7
- CLI Interpreter: Add a new one, name it MAMP-PHP7 and set php executable to `/Applications/MAMP/bin/php/php7.0.12/bin/php`  
When you find php executable, it should display that is found Xdebug  

Go Languages & Frameworks > PHP > debug  
Under Xdebug group, set  
- Debug port 9004
- can accept external connections to true


### Activating debugger
In Phpstorm set a breakpoint  
From PhpStorm click Run > Start Listening for PHP Debug Connections  
Append a query param `XDEBUG_SESSION_START=PHPSTORM` which triggers the debugger  
Example: `http://localhost:7888/topditop/?XDEBUG_SESSION_START=PHPSTORM`