<?php
declare(strict_types=1);

namespace CuePhp\Session;
use SessionHandler;

final class SessionManager 
{

    public function start()
    {
        session_start();
    }

    public function bind()
    {
        session_set_save_handler(  new SessionHandler() , true );
    }

    

}