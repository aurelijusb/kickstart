#!/usr/bin/env bash
# Make us independent from working directory
pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

PASSWORD1='$argon2i$v=19$m=1024,t=2,p=2$ZzVyc2NvUWkvV2ptZGx0bQ$JfK0Lu0QVJrw/j1FqjP4Kn04bVqGCa26ZQTaxHPv9Aw'
SQL1="INSERT INTO user (email, roles, password) VALUES ('admin@admin.lt', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$PASSWORD1')"

PASSWORD2='$argon2i$v=19$m=1024,t=2,p=2$WGpLM2pFaGcwM2JBRDNlNQ$wLD7adbkxlEnpVg2zB8oBO/3dUsKJLQ7RpTEHEdLiAg'
SQL2="INSERT INTO symfony.user (email, roles, password, homepage, password_changed, linkedin) VALUES ('kitas@kitas.lt', '[]', '$PASSWORD2', 'http://nfq.lt', '2019-11-18 22:51:26', 'https://www.linkedin.com/company/nfq/');"

$SCRIPT_DIR/mysql.sh "$SQL1"
$SCRIPT_DIR/mysql.sh "$SQL2"