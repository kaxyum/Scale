<?php

namespace Scale;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\ToastRequestPacket;

class ScaleCMD extends Command{

    public function __construct() {
        $cfg = Main::getInstance()->getConfig();
        parent::__construct($cfg->get("cmdname"),$cfg->get("cmddescription"),"/{$cfg->get("cmdname")}",$cfg->get("cmdaliases"));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $cfg = Main::getInstance()->getConfig();
        if ($sender instanceof Player) {
            if($sender->hasPermission("pocketmine.group.operator")){
                if(empty($args[0])){
                $sender->sendMessage("§c/{$cfg->get("cmdname")} {scale}");
                }else{
                $sender->setScale($args[0]);
                $this->sendToast($sender, $args[0]);
                }
                }elseif($sender->hasPermission($cfg->get("cmdpermission"))){
                if(empty($args[0])){
                $sender->sendMessage("§c/{$cfg->get("cmdname")} {scale}");
                }else{
                $sender->setScale($args[0]);
                $this->sendToast($sender, $args[0]);
                }
            }
        }
    }

    public function sendToast(Player $sender, string $scale): void {
        $cfg = Main::getInstance()->getConfig();
        $sender->getNetworkSession()->sendDataPacket(
            ToastRequestPacket::create($cfg->get("title"), str_replace("{scale}", $scale, $cfg->get("text")))
        );
    }
}
