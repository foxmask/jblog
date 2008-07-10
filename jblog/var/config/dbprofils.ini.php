;<?php die(''); ?>
;for security reasons, don't remove or modify the first line

; name of the default profil to use for any connection
;default = myapp
default = pgsql

; each section correspond to a connection
; the name of the section is the name of the connection, to use as an argument
; for jDb and jDao methods
; Parameters in each sections depends of the driver type

[pgsql]

driver="pgsql"
database="jblog"
host="localhost"
user="postgres"
password=""
persistant=on
force_encoding=on

;[myapp]

; For the most of drivers:
;driver="mysql"
;database="jblog"
;host= "localhost"
;user= "root"
;password=
;persistent= on
; when you have charset issues, enable force_encoding so the connection will be
; made with the charset indicated in jelix config
;force_encoding = on

; For pdo :
;driver=pdo
;dsn=mysql:host=localhost;dbname=jblog
;user=
;password=
