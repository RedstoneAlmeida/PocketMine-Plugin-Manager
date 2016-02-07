<?php
namespace Manager;

use pocketmine\plugin\PluginBase;
use pocketmine\event\plugin\PluginEnableEvent;
use pocketmine\Server;
use pocketmine\plugin\PluginLoader;

class Loader implements PluginLoader {

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
     *
     * @return PluginDescription
     */
    public function enablePlugin(Plugin $plugin) {
        if($plugin instanceof PluginBase and !$plugin->isEnabled()){
            MainLogger::getLogger()->info("Enabling " . $plugin->getDescription()->getFullName());

            $plugin->setEnabled(true);

            Server::getInstance()->getPluginManager()->callEvent(new PluginEnableEvent($plugin));
        }
    }
}
