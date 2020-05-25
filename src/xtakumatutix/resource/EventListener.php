<?php

namespace xtakumatutix\resource;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class EventListener implements Listener 
{
    private $Main;

    public function __construct(Main $Main)
    {
        $this->Main = $Main;
    }

    public function onBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $blockid = $block->getID();
        $blockdamage = $block->getDamage();
        $x = $block->getX();
        $y = $block->getY();
        $z = $block->getZ();
        $level = $player->getLevel()->getName();
        if ($level == "resource")
        {
            switch ($blockid){
                case 1:
                $this->set($blockid, $blockdamage, $x, $y, $z);     
            }
        }
    }

    public function set($blockid, $blockdamage, $x, $y, $z)
    {
        $setblock = Block::get($blockid, $blockdamage);
        $setlevel = $this->Main->getServer()->getLevelByName("resource");
        $Vector3 = new Vector3($x, $y, $z); 
        $task = new ClosureTask(function (int $currentTick) use ($Vector3, $setblock, $setlevel): void {
            $setlevel->setBlock($Vector3, $setblock);
        });
        $plugin = Server::getInstance()->getPluginManager()->getPlugin("Resource");
        /** @var Plugin $plugin */
        $plugin->getScheduler()->scheduleDelayedTask($task, 10);
    }
}