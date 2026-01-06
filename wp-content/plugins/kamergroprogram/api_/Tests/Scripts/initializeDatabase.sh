# Here we create the database and import the database with the content, the content will be deleted.
cd /
mysql --defaults-extra-file=/var/www/wp-content/plugins/kamergroprogram/api_/config/mysq.cnf   </var/www/wp-content/plugins/kamergroprogram/api_/Tests/Scripts/sql/createDatabases.sql
mysql --defaults-extra-file=/var/www/wp-content/plugins/kamergroprogram/api_/config/mysq.cnf kamermuizek_groningen_db_name </var/www/database/kamermuizek_groningen_db_name.sql
