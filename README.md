- composer install
- bin/console doctrine:database:create
- bin/console doctrine:schema:update --force
- bin/console doctrine:fixtures:load
- Visit api/projects.json in your browser

The result should include a attribute for s3FileUrl which is appended through \App\Api\Serializer\ProjectSerializer
