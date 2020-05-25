<?php

namespace xtakumatutix\resource;

use pocketmine\plugin\PluginBase;

Class Main extends PluginBase 
{
    public function onEnable() 
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getLogger()->notice("読み込み完了 - ver.".$this->getDescription()->getVersion());
    }
}