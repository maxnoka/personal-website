find private/ -type d -exec chmod 750 {} \;
find private/ -type f -exec chmod 640 {} \;

find public/ -type d -exec chmod 755 {} \;
find public/ -type f -exec chmod 644 {} \;
