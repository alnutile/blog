@servers(['web' => 'do_blog'])

@task('deploy')
    cd /home/ubuntu/alfrednutile.info
    git pull origin master
    composer install
    npm run production
    sudo chgrp -R www-data storage/
    sudo chmod -R 775 storage/
    sudo chgrp -R www-data bootstrap/
    sudo chmod -R 775 bootstrap/
@endtask
