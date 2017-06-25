<?php

namespace SlashChanger;

use pocketmine\Player;
use pocketmine\Plugin\PluginBase;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}

		$this->c = new Config($this->getDataFolder() . "setting.yml", Config::YAML, array(
			'/' => '.'
		));
	}

	public function Change(PlayerCommandPreprocessEvent $event){
		$text = strtolower($event->getMessage());
		$cslash = $this->c->get("/");
		if(mb_substr($text, 0, 1) == $cslash){
			$event->setMessage("".str_replace($cslash, '/', $text)."");
		}
	}
}