#! /bin/bash
#
# Definición de variables
fecha=`date +"%d-%b-%Y"`
origen="/var/www/"
destino="/media/proyectosDH/Backup"
#
cd $origen
#
# Hacer backup de la base de datos en un fichero .sql y lo guardamos en el origen
mysqldump --user=root --password=123456789 ies > $origen/ies_$fecha.sql
#
# Empaquetamos t comprimimos todo el origen que incluye la carpeta
# html con el codigo fuente y el recien creado .sql
tar -czvf $destino/backup_$fecha.tar.gz ./
#
# eliminamos el .sql creado al principio
rm -rf $origen/ies_$fecha.sql
#
# Borrar los backups de más de 30 dias de antigüedad, tanto sql como gz
find $destino/* -mtime +30 -exec rm {} \;
