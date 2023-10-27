# RDS 세팅

## 파라미터 그룹

1. time_zone Asia/Seoul
2. log_bin_trust_function_creators ON
3. long_query_time 5
4. slow_query_log 1
5. event_scheduler ON

## MySQL bin log 보기 (SHOW BINARY LOGS)

```
mysqlbinlog ^
    --read-from-remote-server ^
    --host=db.kidneylife.co.kr ^
    --port=3306  ^
    --user=root ^
    --password ^
    --to-last-log ^
    --database=kl_999_dev ^
    --result-file=result.sql ^
    --skip-gtids ^
    --base64-output=DECODE-ROWS ^
    --verbose ^
    mysql-bin-changelog.039731
```


# Linux 세팅

## 콘솔 세팅

1. root 패스워드 세팅 (sudo passwd root)
2. ssh 패스워드 접속 (vi /etc/ssh/sshd_config -> PasswordAuthentication yes, PermitRootLogin  yes)
3. yum update
4. rpm -qa (전체) -qi 파일명 (파일의 패키지) -ql 패키지명 (설치된 파일)

## 시스템 세팅

1. /etc/profile 변경
2. mailx, telnet 설치
3. .forward로 메일 설정 (bori0211@gmail.com)
4. 시간대를 한국으로 변경 (cp /usr/share/zoneinfo/Asia/Seoul /etc/localtime)
   (yum으로 glibc 가 update되면 자동으로 변경되어 버림)
   (docs.aws.amazon.com/ko_kr/AWSEC2/latest/UserGuide/set-time.html)

## 네트워크 세팅

1. /etc/resolv.conf, /etc/hosts 적절히 변경

## 메일 세팅

1. 127.0.0.1 25 LISTENER를 0.0.0.0으로 ( sendmail.cf  O DaemonPortOptions=Port=smtp,Addr=0.0.0.0, Name=MTA )
2. local-host-names 에 해당 도메인 등록
3. service sendmail restart

## 아파치 세팅

1. 2.4 부터     <Location /> Require all granted </Location>  필수


## php 로그
1. /var/log/httpd 폴더 권한 (0755로)


## 계정 생성

1. useradd -u 501 -g apache datafirst

## yum 설치된 리스트 보기

1. yum list installed
2. 파일이 속한 패키지 보기 ( yum provides /usr/bin/convert )  ( rpm -qf /usr/bin/convert )
3. 패키지 정보 보기 ( rpm -ql ImageMagick-6.7.8.9-15.amzn2.x86_64 ) ( rpm -qi ImageMagick-6.7.8.9-15.amzn2.x86_64)

## yum으로 node 설치

1. $ curl --silent --location https://rpm.nodesource.com/setup_10.x | bash -
2. $ yum -y install nodejs

## mailsend 옵션 (보안 관련 옵션 변경 필요)

1. https://github.com/muquit/mailsend
2. https://serverfault.com/questions/635139/how-to-fix-send-mail-authorization-failed-534-5-7-14
3. mailsend -to bori0211@naver.com -from chickendinner.me@gmail.com   -ssl -port 465 -auth-login   -smtp smtp.gmail.com   -sub "이것은 시험중" -user bori0211 -pass "INPUTPW" -M "This is a test."
4. mailsend -to bori0211@naver.com -from chickendinner.me@gmail.com   -starttls -port 587 -auth   -smtp smtp.gmail.com   -sub test +cc +bc -v   -user bori0211 -pass "INPUTPW"

## 서비스 패키지

1. awscliv2
2. mysql80-community
3. telegraf-1.19.0

## 기타 패키지

1. tree, htop
2. wget, curl


## 아파치 특정 Refer 막기 (특정 Refer만 허용가능)

```
SetEnvIf Referer "^http://tvzonebbs1.media.daum.net/"  spam_referal

<directory home="home" cine21.com="cine21.com" host.image="host.image">
         Order allow,deny
         Allow from all
         Deny from env=spam_referal
</directory>
```

## puppeteer (Amazon Linux)

1. https://github.com/puppeteer/puppeteer/issues/1598
2. On a barebones install of CentOS 7 (on Amazon AWS EC2), I was able to get chrome headless running with the following:
3. sudo yum install atk java-atk-wrapper at-spi2-atk gtk3 libXt


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
