echo -e '\E[1;33;44m' "Setting your local timezone - Done"; tput sgr0
echo date.timezone = UTC >> ~/.parts/etc/php5/php.ini

rm symfonyconfig.sh