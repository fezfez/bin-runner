Bin runner
=============

> run command in background and manage it.

This project is tagged WIP cause of the missing unit test and missing unix driver


Install
=======

```bash
composer require fezfez/bin-runner
```


How to use
====

php server sample


### start 

```bash
vendor/bin/bin-runner start "php -S localhost:8887 -t public"
# Process created with alias "php"
```

Then you can go to localhost:8887, the php server is up
 
### status
 
 ```bash
vendor/bin/bin-runner show

+-------+---------------------------------+------+------------+
| alias | command                         | pid  | is running |
+-------+---------------------------------+------+------------+
| php   | php -S localhost:8887 -t public | 1572 | 1          |
+-------+---------------------------------+------+------------+
```

### stop by alias

 ```bash
vendor/bin/bin-runner stop php
# php stop successfully
```

### stop by pid
 ```bash
vendor/bin/bin-runner stop 1572
# php stop successfully
```

### stop all
 ```bash
vendor/bin/bin-runner stop 
# php stop successfully
```
