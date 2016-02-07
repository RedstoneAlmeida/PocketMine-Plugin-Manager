<?php
namespace Manager;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\plugin\PluginLoadOrder;

class Main extends pluginBase implements Listener  {

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->alert(": This Plugin does not manage plugins loaded through the DevTools plugin.");
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {
        if(strtolower($cmd->getName())==="manage") {
            $sender->sendMessage(Color::YELLOW . "");
            return true;
        }
        if(strtolower($cmd->getName())==="enable") {
            if(count($args) === 1) {
                if($this->pEnable()) {
                    $sender->sendMessage(Color::YELLOW."$args[1] has been re-enabled!");
                }else{
                    $sender->sendMessage(Color::BOLD.Color::RED."$args[1] failed to be re-enabled!");
                }
                $this->getServer()->broadcastMessage(Color::YELLOW."$args[1] has been re-enabled!");
                return true;
            }else{
                $sender->sendMessage(Color::YELLOW . "There needs to be only one argument after this command.");
                return false;
            }
        }
        if(strtolower($cmd->getName())==="disable") {
            if(count($args) === 1) {
                if($this->pDisable()){
                    $sender->sendMessage(Color::YELLOW."$args[1] has been disabled!");
                }else{
                    $sender->sendMessage(Color::BOLD.Color::RED."$args[1] failed to be disabled!");
                }
                return true;
            }else{
                $sender->sendMessage(Color::YELLOW . "There needs to be only one argument after this command.");
                return false;
            }
        }
        return true;
    }

    public function pEnable() {
        $this->getServer()->getPluginManager()->registerInterface("FolderPluginLoader\\FolderPluginLoader");
        $this->getServer()->getPluginManager()->loadPlugins($this->getServer()->getPluginPath(), ["FolderPluginLoader\\FolderPluginLoader"]);
        $this->getServer()->enablePlugins(PluginLoadOrder::POSTWORLD);
    }

    public function pDisable() {

    }

    public function checkEnabled() {

    }
}