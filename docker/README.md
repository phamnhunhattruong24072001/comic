1. https://github.com/phamnhunhattruong24072001/comic.git

2. cd docker
   - run            "docker compose build --no-cache"
   - run            "docker compose up -d"
   - run commad     "docker exec -it laravel_comic bash"
   - run            "composer i" or "composer u"
   - run            "php artisan key:generate"
   - run            "cp .env.example .env"
3. Set up .env
    DB_CONNECTION=mysql
    DB_HOST=db-comic
    DB_PORT=3306
    DB_DATABASE=comic
    DB_USERNAME=root
    DB_PASSWORD=root