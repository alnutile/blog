<<<<<<< HEAD
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
=======
@servers(['web' => 'ubuntu@alfrednutile.info'])

@task('deploy', ['on' => 'web'])
    cd /home/ubuntu/alfrednutile.info
    git pull origin master
>>>>>>> 4628ee1840d8482b53b435d1c1bddc40057087db
@endtask
