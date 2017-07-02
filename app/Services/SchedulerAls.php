<?php namespace App\Services;

use Carbon\Carbon;

class SchedulerAls
{

    public function fire($job, $data)
    {
        $id = $job->getJobId();
        \Log::info("Testing: JobID {$id}");
        $this->processPost($job, $data);
    }

    protected function processPost($job, $data)
    {
        if (isset($data['post'])) {
            $id = $data['post'];
            $post = \Post::find($id);
            if ($post) {
                $scheduled = strtotime($post->scheduled);
                $now = date('U'); //carbon did not work in tinker so hard to troubleshoot
                \Log::info("Compare scheduled to now $scheduled < $now");
                if ($scheduled <= $now) {
                    $post->active = 1;
                    $post->save();
                    $job->delete();
                } else {
                    $job->release(30);
                }
            } else {
                $job->delete();
            }
        } else {
            $job->delete();
        }
    }

    public function setSchedule($data)
    {
        if (isset($data['scheduled']) && !isset($data['active'])) {
            $time = date("Y-m-d H:i:s", strtotime($data['scheduled']));
            $data['scheduled'] = $time;
        }
        return $data;
    }

    public function sendToQueue($post)
    {
        if (!empty($post->scheduled)) {
            \Log::info("Testing: PushJob {$post->id}");
            \Queue::push('Als\Services\SchedulerAls', array('post' => $post->id));
        }
    }
}
