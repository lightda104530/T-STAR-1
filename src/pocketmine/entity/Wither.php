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
use pocketmine\item\Item as ItemItem;

class Wither extends FlyingAnimal{
	const NETWORK_ID = 52;
	public $width = 0.72;
	public $length = 6; //TODO: Find the good one.
	public $height = 2;
	public $dropExp = 50;
	
	public function getName() : string{
		return "Wither";
	}
	public function initEntity(){
		$this->setMaxHealth(300);
		parent::initEntity();
	}
	
	public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->eid = $this->getId();
		$pk->type = Wither::NETWORK_ID;
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
	//TODO: Add his spawn scenario and his death scenario
	public function getDrops(){
		$drops = [ItemItem::get(ItemItem::NETHER_STAR, 0, 1)];
		return $drops;
	}
}
