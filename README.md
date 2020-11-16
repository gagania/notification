- copy/clone https://github.com/gagania/notification.git ke folder :
  - windows /xampp/htdocs
  - linux /var/www/html 
- jalan kan webservice (xampp windows, apache linux)
 
- untuk melakukan send sms melalui vendor gunakan :
  asumsi request parameter adalah id customer atau no telp
  http://localhost/notification/api/notification/index/1

- untuk melihat data vendor :
  localhost/notification/api/vendor/index

- untuk merubah vendor yang aktif :
  localhost/notification/api/vendor/change_flag (param id,flag)

- vendor data file : vendor.json
