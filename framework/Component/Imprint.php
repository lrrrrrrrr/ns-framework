<?php
/**
 * Created by IntelliJ IDEA.
 * User: E31
 * Date: 13.12.2017
 * Time: 16:19
 */

namespace framework\Component;


use framework\Base\Component;

class Imprint extends Component
{
    public function getImprint() {
        $config = $this->getConfig();
        if (!isset($config['text'])) {
            return '';
        }

        return $config['text'];
    }
}