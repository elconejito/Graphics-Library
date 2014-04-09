<?php

class Modal extends \Eloquent {
    public $type;
    public $title;
    public $body;
    public $buttons;
	protected $fillable = [];

    public function __construct() {
        // only one default button which is close
        $this->buttons = [
            'close' => [
                'text' => 'Close',
                'class' => 'btn btn-default',
                'data' => [
                    'dismiss' => 'modal'
                ]
            ]
        ];
    }

    public function printButtons() {
        // init the button so it at least returns an empty string
        $btnText = '';
        foreach ( $this->buttons as $button ) {
            $class = $button['class'];
            $data = '';
            if ( !empty($button['data']) ) {
                foreach ( $button['data'] as $k => $v ) {
                    $data .= sprintf('data-%s="%s" ', $k, $v);
                }
            }
            $text = $button['text'];
            // close up the button
            $btnText .= sprintf('<button type="button" class="%s" %s>%s</button>', $class, $data, $text);
        }
        return $btnText;
    }
}