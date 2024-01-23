<?php

declare(strict_types=1);

namespace AliJr\Sex;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\level\particle\DustParticle;
use pocketmine\level\sound\PlaySound;
use pocketmine\network\mcpe\NetworkBroadcastUtils;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{
// plugin written by AliJr
	public function onEnable() : void{
		$this->getLogger()->info(C::GREEN . "Plugin Sex RUNNED BY ALIJR");
		$this->getLogger()->alert(C::GREEN . "Sex Plugin Runned ON API 3.0.0 (this plugin is a fun), subscribe a my github.com/everythingdev");
		$this->getServer()->dispatchCommand(new ConsoleCommandSender(), C::GOLD ."Sex Plugin is success Runned!");

	}

	public function onDisable() : void{
		$this->getLogger()->info(C::RED . "Plugin has been disabled");
	}

	public function onCommand(\pocketmine\command\CommandSender $player, \pocketmine\command\Command $command, string $label, array $args): bool{

		if($command->getName() == "sex"){
			if($player instanceof Player){
				$this->openpanel($player);
			}else{
				$player->sendMessage("§4[ Sex ] §cUse This Command In Game");
			}

		}


		return true;

	}

	public function openpanel($player){
		$api= $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$this->sex($player);

					break;
				case 1:
					$this->pregnant($player);
					break;
				case 2:
					$this->fap($player);
					break;

			}
		});
		$form->setTitle("§4§lSex System");
		$form->setContent("§aPlease select a button:)!");
		$form->addButton("§cSex");
		$form->addButton("§cPregnant");
		$form->addButton("§cFap");
		$form->sendToPlayer($player);
		return $form;
	}

	public function pregnant(player $player){
		$api = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");

		$form = $api->createCustomForm(function(player $player, array $data = null){


			if($data === null){
				return true;
			}
			$target = $this->getServer()->getPlayer($data[1]);
			if ($target !== null){
				if(strtolower($data[1]) === strtolower($player->getName())){
					$player->sendMessage("§cYou cannot get yourself pregnant");
					return;
				}
				if($data === null){
				}

				$namet = $target->getName();
				$name = $player->getName();
				$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell $data[1] §aPlayer $name got pregnant you §c- Awwwww:))");
				$player->sendMessage("§a You made pregnant $data[1] - §c Awwwwww:))");
			}else{
				$player->sendMessage("§cPlayer $data[1] is not online");
			}


		});

		$form->setTitle("§4§lPregnant");
		$form->addLabel("§aGet your girlfriend pregnant");
		$form->addInput("GirlFriend Name", "Type here...");
		$form->sendToPlayer($player);
		return $form;
	}


	public function sex(player $player){
		$api = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");

		$form = $api->createCustomForm(function(player $player, array $data = null){


			if($data === null){
				return true;
			}
			$target = $this->getServer()->getPlayer($data[1]);
			if($target !== null){
				if(strtolower($data[1]) === strtolower($player->getName())){
					$player->sendMessage("§cYou can't have sex yourself");
					return;
				}
				if($data === null){
				}

				$namet = $target->getName();
				$name = $player->getName();
				$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell $data[1] §aPlayer §e$name §c Is Sexing With You §4- Awwww:)!");
				$player->sendMessage("§aYou Are Sexing with $data[1] - Awwww:)!");
			}else{
				$player->sendMessage("§cPlayer $data[1] Is not online");
			}


		});

		$form->setTitle("§c§lSex §4(HARD)");
		$form->addLabel("§cSex with your girlfriend");
		$form->addInput("GirlFriend Name", "Type here...");
		$form->sendToPlayer($player);
		return $form;
	}

	public function fap(player $player){
		$player->sendMessage(C::GREEN . "[SEX]" . C::RED . "you is faping now:(");
		$name122 = $player->getName();

		$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "say [Sex-System] Player $name122 is faping now");

	}

}
