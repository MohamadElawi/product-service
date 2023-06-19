<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ite\IotCore\Managers\UserActivityManager;
use Ite\IotCore\Models\UserActivity;
use JsonMapper;

class BlockedUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user, $message;
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserActivityManager $manager)
    {
        // echo $this->user->id .' '. $this->user->user_name .' '. $this->message .PHP_EOL ;
        //                $mapper = new JsonMapper();
        // //                /** @var UserActivity $userActivity */
        //                $mapper->bStrictNullTypes = false;
        //                $userActivity = $mapper->map($this->user, new UserActivity());
        $userActivity = new UserActivity();
        $userActivity->id = $this->user['id'];
        $userActivity->name =$this->user['user_name'] ;
        if($this->message == 'blocked')
            $manager->add($userActivity);
        else
            $manager->remove($userActivity);
    }
}
