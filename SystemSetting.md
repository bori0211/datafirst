# Linux 111 222 333

## 시스템 세팅

1. root 패스워드 세팅 (sudo passwd root)
2. ssh 패스워드 접속 (vi /etc/ssh/sshd_config -> PasswordAuthentication yes, PermitRootLogin  yes)
3. yum list installed
4. yum update
5. rpm -qa (전체) -qi 파일명 (파일의 패키지) -ql 패키지명 (설치된 파일)
6. 파일이 속한 패키지 보기 ( yum provides /usr/bin/convert )  ( rpm -qf /usr/bin/convert )
7. 패키지 정보 보기 ( rpm -ql ImageMagick-6.7.8.9-15.amzn2.x86_64 ) ( rpm -qi ImageMagick-6.7.8.9-15.amzn2.x86_64)
8. 패키지1 (awscliv2, mysql80-community, telegraf-1.19.0)
9. 패키지2 (tree, htop, wget, curl)
10. 패키지3 (mailx, telnet)
11. /etc/profile 변경
12. .forward로 메일 설정 (bori0211@gmail.com)
13. 시간대를 한국으로 변경
14. UPDATE에 제외할 패키지: exclude=mysql84-community-release nodejs22*

```sh
useradd -u 501 -g apache datafirst
```


## 네트워크 세팅

1. /etc/resolv.conf, /etc/hosts 적절히 변경

## 아파치 세팅

1. 2.4 부터     <Location /> Require all granted </Location>  필수

```
# 아파치 특정 Refer 막기 (특정 Refer만 허용가능)
SetEnvIf Referer "^http://tvzonebbs1.media.daum.net/"  spam_referal

<directory home="home" cine21.com="cine21.com" host.image="host.image">
         Order allow,deny
         Allow from all
         Deny from env=spam_referal
</directory>
```

## php 로그
1. /var/log/httpd 폴더 권한 (0755로)
2. php_error.log 쓰기 권한 (chown apache:apche /var/log/php_error.log)

|php.ini|Target|Default|
|---|:---:|:---:|
|short_open_tag|On|Off|
|expose_php|On|Off|
|error_reporting|E_ALL & ~E_NOTICE|E_ALL & ~E_DEPRECATED & ~E_STRICT|
|display_startup_errors|On|Off|
|html_errors|On||
|error_log|/var/log/php_error.log||
|upload_max_filesize|8M|2M|
|date.timezone|Asia/Seoul||
|session.gc_divisor|1|1000|
|session.gc_maxlifetime|7200|1440|

<br><br>

# RDS 세팅

## 파라미터 그룹

|파라미터|Target|Default|
|---|:---:|:---:|
|innodb_buffer_pool_size|268435456|{DBInstanceClassMemory*3/4}|
|innodb_file_per_table|0|1|
|innodb_flush_log_at_trx_commit|0||
|log_bin_trust_function_creators|1||
|log_error_verbosity|2||
|log_output|FILE|TABLE|
|long_query_time|1||
|skip_name_resolve|1||
|slow_query_log|1||
|time_zone|Asia/Seoul||
|transaction_isolation|READ-COMMITTED||

## MySQL bin log 보기 (SHOW BINARY LOGS)

```
mysqlbinlog ^
    --read-from-remote-server ^
    --host=db.datafirst.co.kr ^
    --port=3306  ^
    --user=root ^
    --password ^
    --to-last-log ^
    --database=kl_999_dev ^
    --result-file=result.sql ^
    --skip-gtids ^
    --base64-output=DECODE-ROWS ^
    --verbose ^
    mysql-bin-changelog.526995
```

<br><br>

# Windows 세팅

## PING 허용

1. (관리자 CMD) netsh advfirewall firewall add rule name="ICMP Allow" protocol=icmpv4:8,any dir=in action=allow

## 사용된 IP 확인

1. nmap -sP -PR 192.168.0.*
2. nmap -sP -PR 61.78.127.99/28
3. nmap -T2 -F 192.168.0.0/24 (TCP Port)

# .bash_profile

```
# Get the aliases and functions
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi

# User specific environment and startup programs

#PATH=$PATH:$HOME/.local/bin:$HOME/bin
#PATH=$PATH:/c/xampp/php
#PATH=$PATH:/c/'Program Files'/php
#export PATH
#export GREP_OPTIONS="--exclude-dir=.git --exclude-dir=.svn --exclude-dir=node_modules --exclude-dir=bower --exclude-dir=vendor --exclude=bundle.js --exclude=style.css"

# PS1
export PS1="[\u@\h \W]\$ "

##git --version
##echo ""

bash --version
echo ""

# 한글
chcp.com 949
echo ""

# 기본 경로
cd /c/dev
```

## .minttyrc

```
Font=굴림체
FontHeight=12
Columns=120
Rows=36
CursorType=block
CursorColour=0,255,0
RightClickAction=menu
MiddleClickAction=extend
```

## start_taskmgr.cmd

```
start taskmgr.exe
rem node node_exec_test.js
```

## start_wsl.bat

```
rem wsl -u root -- service redis-server start
rem wsl -u root -- service ssh start
rem wsl -u root -- service apache2 start
rem wsl -u root -- systemctl start redis-server
rem wsl -u root -- systemctl start ssh
```

## autorun.bat

```
@echo off
REM Unix in Win Start here
REM KEY_CURRENT_USER\Software\Microsoft\Command Processor
REM AutoRun (String) (C:\Users\김석태\autorun.bat)

REM doskey ls=dir/w $*
REM doskey ll=dir $*
REM doskey cat=type $*
REM doskey pwd=cd

REM doskey cp=copy $*
REM doskey mv=move $*
REM doskey rm=del $*

REM doskey grep=find "$1" $2 
REM doskey ps=tasklist $*
```
