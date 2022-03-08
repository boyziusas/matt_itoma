<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $logoCID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->logoCID = \Swift_DependencyContainer::getInstance()
            ->lookup('mime.idgenerator')
            ->generateId();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function (\Swift_Message $swift){
            $image = new \Swift_Image(\Storage::disk('public')->get('goat.jpg'),
            "Logo.jpg",
            "image/jpg"
            );
            $swift->embed($image->setId($this->logoCID));
        });
        View::share('logoCID', $this->logoCID);
    }

    /**
     * @param \Swift_Message $swift
     * @param $items
     */
    protected function embedImages(\Swift_Message $swift, $items):void
    {
        foreach($items as $key => $item) {
            $image = new \Swift_Image(\Storage::disk('public')->get($item['image']),
                'test.jpg',
                'image/jpg');
            $swift->embed($image->setId($this->image_CID[$key]));
        }
    }

    /**
     * @param $items
     * @throws \Swift_DependencyException
     */
    protected function loadImageCids($items):void
    {
        foreach($items as $key => $item ){
            $this->image_CID[$key] = \Swift_DependencyContainer::getInstance()
                ->lookup('mime.idgenerator')
                ->generateId();
        }
    }
}
