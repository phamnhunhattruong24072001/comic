# Storage link
"php artisan storage:link"
# Laravel passport
"composer require laravel/passport"

"php artisan migrate"

# Setup pusher 

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=1586054
PUSHER_APP_KEY=7b9820360c55a6a7b6f5
PUSHER_APP_SECRET=881238f538e9e504da29
PUSHER_APP_CLUSTER=ap1 

# Imgur
IMGUR_CLIENT_ID=d32559c541e9111
IMGUR_CLIENT_SECRET=1220b07e3dfecd41b6486fc070baf2bbc3e3265c

# Setup Vuejs
Đối với trường hợp docker file có nodejs là v10 thì xoá docker chạy lại
- composer require laravel/ui
- php artisan ui vue
- php artisan ui vue --auth
- npm install && npm run dev
- npm run watch => để lắng nghe sự thay đổi của file
