@servers(['web' => 'ubuntu@alfrednutile.info'])

@task('deploy', ['on' => 'web'])
    cd /home/ubuntu/alfrednutile.info
    git pull origin master
@endtask
