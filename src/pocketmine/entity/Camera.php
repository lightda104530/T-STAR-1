<?php
/*
 *
 * ________              ________                         _________     
 *｜　　　 ｜ / ￣￣￣|  ｜　　　  ｜     /￣￣￣\          |   ___   |
 * ￣|　|￣  | /￣￣      ￣|　|￣      / /￣￣\  \        |  |___|  |
 *   |  |    \ \_____      |  |      /  /     \  \       |      ___| 
 *   |  |     \_____  \    |  |     /  /_______\  \      |  |\  \
 *   |  |           | |    |  |    /               \     |  | \  \
 *   |  |      _____/ |    |  |   /  /￣￣￣￣￣￣\  \    |  |  \  \
 *   |__|     |_______/    |__|  /  /             \  \   |__|   \__\
 *
 *
 *
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author DockCreaTer Team
 * @link http://www.github.com/DockCreaTer/
 * 
 *
*/

namespace pocketmine\entity;

use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item as ItemItem;

class Camera extends Living{
	const NETWORK_ID = 62;
	public $width = 1;
	public $length = 2;
	public $height = 2;
	
	public function getName() : string{
		return "Camera";
	}
	
	public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->eid = $this->getId();
		$pk->type = Camera::NETWORK_ID;
		$pk->x = $this->x;
		$pk->y = $this->y;
		$pk->z = $this->z;
		$pk->speedX = $this->motionX;
		$pk->speedY = $this->motionY;
		$pk->speedZ = $this->motionZ;
		$pk->yaw = $this->yaw;
		$pk->pitch = $this->pitch;
		$pk->metadata = $this->dataProperties;
		$player->dataPacket($pk);
		parent::spawnTo($player);
	}
	
	public function getDrops(){
		return [];
	}
}
