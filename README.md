# Reservation Service

## Commands

### Quick Installation
```bash
./vendor/bin/sail up -d
```

```bash
./vendor/bin/sail artisan migrate
```

```bash
./vendor/bin/sail artisan db:seed
```
### Make server available
```bash
./vendor/bin/sail artisan serve
```

### Make directories writeable for container? (maybe there is a different solution)
```bash
touch ./storage/logs/laravel.log
chmod 777 ./storage/framework/sessions/
chmod 777 ./storage/framework/views/
chmod 777 ./storage/framework/cache/data/
```
