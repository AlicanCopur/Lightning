<?php

/** 
*     _    _ _                  ____ 
*    / \  | (_) ___ __ _ _ __  / ___|
*   / _ \ | | |/ __/ _` | '_ \| |    
*  / ___ \| | | (_| (_| | | | | |___ 
* /_/   \_\_|_|\___\__,_|_| |_|\____|
*                                 
*                                  
*  -I'm getting stronger if I'm not dying-
*
* @version 1.0
* @author AlicanCopur
* @copyright HashCube Network © | 2015 - 2020
* @license Açık yazılım lisansı altındadır. Tüm hakları saklıdır. 
*/                      

namespace AlicanCopur\Lightning;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase{
	
  
  public function onCommand(CommandSender $o, Command $cmd, string $label, array $args):bool{
	if(!$o instanceof Player) return false;
  	if($o->hasPermission("lightning.use")){
  		$this->createLightning($o->getX(), $o->getY(), $o->getZ(), $o->getLevel());
  	}
  	return true;
  }
  
  public function createLightning($x, $y, $z, $level){
    $pk = new AddActorPacket();
    $pk->type = 93;
    $pk->entityRuntimeId = Entity::$entityCount++;
    $pk->motion = null;
    $pk->position = new Vector3($x, $y, $z);
    foreach($level->getPlayers() as $pl){
      $pl->dataPacket($pk);
    }
  }
}
