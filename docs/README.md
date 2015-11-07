

./yiic upmc-gii -module=gallery

tbl_gallery_item
tbl_gallery_section
tbl_gallery_tag
tbl_gallery_item_tag

backend/controllers/gallery/ItemController.php
backend/controllers/gallery/SectionController.php
backend/controllers/gallery/TagController.php
backend/views/gallery/item/_form....php
backend/views/gallery/section/_form....php
backend/views/gallery/tag/_form....php

frontend/controllers/gallery/ItemController.php
frontend/controllers/gallery/SectionController.php
frontend/controllers/gallery/TagController.php
frontend/views/gallery/item/[list/add/edit].php
frontend/views/gallery/section/[list/add/edit]....php
frontend/views/gallery/tag/[list/add/edit]....php




Генерация с помощью командной строки!!!!

_id - внешний ключ ( category_id: int 11 unsign null )
_index - простой список ( state_index,  type_index: int 1 unsign not null )
_image - изображение (  preview_image, big_image, small_image: varchar 255 )
_file - файл, документ ( doc_file: varchar 255 ) - тоже что image но другие типы и без превью
_date - дата ( publish_date, timestamp )
_datetime - дата время ( created_datetime, timestamp )
_time - время ( started_time, int 4 unsign )
_flag - checkbox ( publish_flag, active_flag, int 1 unsign, not null default: 0 )
_phone, phone ( phone, mobile_phone: varchar 255 ) - виджет с masked телефона
_email, email (email, main_email: varchar 255) - виджет с masked  mail
