<?php

namespace AlicanCopur\Lightning;

use pocketmine\level\Level;
use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase{
	
  public function onEnable(){
  }
  
  public function onCommand(CommandSender $o, Command $cmd, string $label, array $args):bool{
  	if($cmd->getName() == "lightning" && $o->hasPermission("lightning.use")){
  		$x = $o->getX();
  		$y = $o->getY();
  		$z = $o->getZ();
  		$level = $o->getLevel();
  		$this->createLightning($x, $y, $z, $level);
  	}
  	return true;
  }
  
  public function createLightning($x, $y, $z, $level){
    $pk = new AddEntityPacket();
    $pk->type = 93;
    $pk->entityRuntimeId = Entity::$entityCount++;
    $pk->motion = null;
    $pk->position = new \pocketmine\math\Vector3($x, $y, $z);
    foreach($level->getPlayers() as $pl){
      $pl->dataPacket($pk);
    }
  }
}
