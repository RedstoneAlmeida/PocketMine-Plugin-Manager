<?php
namespace Manager;

use pocketmine\plugin\PluginBase;
use pocketmine\event\plugin\PluginEnableEvent;
use pocketmine\Server;
use pocketmine\plugin\PluginLoader;
use pocketmine\utils\MainLogger;

class Loader {

    /** @var Server */
    private $server;

    /**
     * @param Server $server
     */
    public function __construct(Server $server) {
        $this->server = $server;
    }

    /**
     * Gets the PluginDescription from the file
     *
     * @param string $file
     */
    public function enablePlugin($plugin) {
        if($plugin instanceof PluginBase and !$plugin->isEnabled()){
            MainLogger::getLogger()->info("Enabling " . $plugin->getDescription()->getFullName());
            $plugin->setEnabled(true);
            Server::getInstance()->getPluginManager()->callEvent(new PluginEnableEvent($plugin));
        }
    }
}
