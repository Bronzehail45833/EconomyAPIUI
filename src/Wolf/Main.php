<?php

namespace Wolf;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\{command\ConsoleCommandSender, Server, Player, utils\TextFormat};
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getLogger()->Info("§aEconomyAPIUI has been enabled!\n\n\n\n\§l§b§onSubcribe channel Wolfkid!!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "ecoui":
			$this->mainForm($player);
        }
        return true;
    }
	
	public function mainForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createSimpleForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				if(isset($data[0])){
					switch($data[0]){
						case 0:
						$this->paymoneyForm($player);
						break;
					
					}
				}
			});
			$form->setTitle("§l§eMoney §bMenu");
			$form->setContent("§o§aPlease Choose One Command!");
			$form->addButton("§l§6Create a Faction"
			$form->sendToPlayer($player);
		}
	}
	
	public function paymoneyForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerName = $data[0];
					$this->moneyPay = $data[1];
					$this->getServer()->getCommandMap()->dispatch($player, "f create " . $this->playerName . $this->moneyPay);
				}
			});
			$form->setTitle("§l§bPay §eMoney §b To Another Player");
			$form->addInput("§oType Player Name And Money To Pay");
			$form->sendToPlayer($player);
		}
	}
	
	
