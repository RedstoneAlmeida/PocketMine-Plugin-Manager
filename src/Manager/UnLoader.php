<?php
namespace Manager;

use pocketmine\plugin\PluginBase;
use pocketmine\event\plugin\PluginDisableEvent;
use pocketmine\Server;
use pocketmine\plugin\PluginLoader;
use pocketmine\utils\MainLogger;

class UnLoader {

    /** @var Server */
    private $server;

    /**
     * @param Server $server
     */
    public function __construct(Server $server) {
        $this->server = $server;
    }

    /**
     * @param $plugin
     */
    public function disablePlugin($plugin) {
        if($plugin instanceof PluginBase and $plugin->isEnabled()){
            MainLogger::getLogger()->info("Disabling " . $plugin->getDescription()->getFullName());
            Server::getInstance()->getPluginManager()->callEvent(new PluginDisableEvent($plugin));
            $plugin->setEnabled(false);
        }
    }
}
