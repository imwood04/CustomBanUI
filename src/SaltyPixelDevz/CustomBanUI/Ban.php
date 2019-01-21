<?php

declare(strict_types=1);

namespace SaltyPixelDevz\CustomBanUI;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Ban extends PluginBase{


	public function onEnable() : void{
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "banish":
				$this->BanishUI($sender);
				return true;
			default:
				return false;
		}
	}

	public function BanishUI(Player $player){
	    $form = new SimpleForm(function (Player $player, int $data = null) : void {
	        $cfg = $this->getConfig();
	        $BanUI = $data;
            if ($data === 0){
                $this->Ban($player, $BanUI);
            }
            if ($data === 1){
                $this->TempBan($player, $BanUI);
            }
            if ($data === 2){
                //Nothing
                $player->sendMessage($cfg->getNested("Message.Exit"));
            }
        });
	    $cfg = $this->getConfig();
	    $form->setTitle($cfg->getNested("Titles.BanishUI"));
	    $form->setContent($cfg->getNested("Message.What"));
	    $form->addButton($cfg->getNested("Buttons.BanPlayer"));
        $form->addButton($cfg->getNested("Buttons.TempBanPlayer"));
        $form->addButton($cfg->getNested("Buttons.Exit"));
        $player->sendForm($form);
    }

    public function Ban(Player $player, $BanUI)
    {
        $form = new SimpleForm(function (Player $player, int $data = null) use ($BanUI) {
            var_dump($data);
        });

        $cfg = $this->getConfig();
        $form->setTitle($cfg->getNested("Titles.BanUI"));
        $form->setContent($cfg->getNested("Message.Ban"));

        $player->sendForm($form);
    }
}
