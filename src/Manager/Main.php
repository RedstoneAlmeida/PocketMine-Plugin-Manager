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

    private $plugin;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->alert(": This Plugin does not manage other plugins loaded through DevTools.");
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {
        if(strtolower($cmd->getName())==="manage") {
            $sender->sendMessage(Color::YELLOW . "Filler Text.");
            return true;
        }
        if(strtolower($cmd->getName())==="enable") {
            if(count($args) === 1) {
                if($this->pEnable()) {
                    $this->getServer()->broadcastMessage(Color::YELLOW."$args[1] has been Re-Enabled!");
                    return true;
                }else{
                    $sender->sendMessage(Color::YELLOW."$args[1] is already Enabled!");
                    return true;
                }
            }else{
                $sender->sendMessage(Color::YELLOW . "There needs to be only one argument after this command.");
                return false;
            }
        }
        if(strtolower($cmd->getName())==="disable") {
            if(count($args) === 1) {
                if(!strtolower($args[0])==="plugmanager") {
                    if($this->pDisable()){
                        $this->getServer()->broadcastMessage(Color::YELLOW."$args[1] has been disabled!");
                        return true;
                    }else{
                        $sender->sendMessage(Color::YELLOW."$args[1] is already Disabled!");
                        return true;
                    }
                }else{
                    $sender->sendMessage(Color::BOLD.Color::RED."You can't disable the Plugin Manager!");
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
        if(!$this->checkEnabled($this->plugin)) {
            $this->getServer()->getPluginManager()->registerInterface("FolderPluginLoader\\FolderPluginLoader");
            $this->getServer()->getPluginManager()->loadPlugins($this->getServer()->getPluginPath(), ["FolderPluginLoader\\FolderPluginLoader"]);
            $this->getServer()->enablePlugins(PluginLoadOrder::POSTWORLD);
            return true;
        }else{
            return false;
        }
    }

    public function pDisable() {
        if($this->checkEnabled($this->plugin)) {
            $this->getServer()->disablePlugins();
            return true;
        }else{
            return false;
        }
    }

    public function checkEnabled($p) {
        if($p) {
            return true;
        }else{
            return false;
        }

    }
}