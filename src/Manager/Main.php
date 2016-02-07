<?php
namespace Manager;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\event\Listener;

class Main extends pluginBase implements Listener {

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->alert(Color::YELLOW . ": This Plugin does not manage plugins loaded through the DevTools plugin.");
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {
        if(strtolower($cmd->getName())==="manage") {
            $sender->sendMessage(Color::YELLOW . "This is a filler message.");
            return true;
        }
        if(strtolower($cmd->getName())==="enable") {
            if(count($args) === 1) {
                $sender->sendMessage(Color::YELLOW . "This is a filler message.");
                //$this->pEnable();
                return true;
            }else{
                $sender->sendMessage(Color::YELLOW . "There can only be one argument after this command.");
                return false;
            }
        }
        if(strtolower($cmd->getName())==="disable") {
            if(count($args) === 1) {
                $sender->sendMessage(Color::YELLOW . "This is a filler message.");
                //$this->pDisable();
                return true;
            }else{
                $sender->sendMessage(Color::YELLOW . "There can only be one argument after this command.");
                return false;
            }
        }
        return true;
    }

    public function pEnable() {

    }

    public function pDisable() {

    }

    public function checkEnabled() {

    }
}
