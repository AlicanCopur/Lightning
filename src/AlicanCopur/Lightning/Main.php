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

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase{
	
  
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
      if(!$sender instanceof Player) return false;
      if($sender->hasPermission("lightning.use")){
	  if(isset($args[0])){
	      if($player = $this->getServer()->getPlayer($args[0]) instanceof Player){
	          $pos = $player->asVector3();
	      } else {
		  $pos = $sender->asVector3();    
	      }
	  } else {
	      $pos = $sender->asVector3();
	  }
          $this->createLightning($pos, $sender->getLevel());
      }
      return true;
  }
  public function createLightning(Vector $pos, Level $level){
    $pk = new AddActorPacket();
    $pk->type = 93;
    $pk->entityRuntimeId = Entity::$entityCount++;
    $pk->motion = null;
    $pk->position = $pos;
    foreach($level->getPlayers() as $pl){
      	$pl->dataPacket($pk);
    }
  }
}
