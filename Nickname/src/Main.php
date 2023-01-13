<?php

// declare(strict_types=1);

namespace kitsu\Nickname;

use kitsu\Nickname\Commands\NicknameCommand;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class Main extends PluginBase implements Listener{
    public function onEnable() : void {
        $this -> getLogger() -> info(TextFormat::GREEN . "Nickname plugin has been enabled");
        $this -> getServer() -> getPluginManager() -> registerEvents($this, $this);
        $this -> registerCommands();
    }

    public function registerCommands() {
        $this -> getServer() -> getCommandMap() -> register('disguise', new NicknameCommand());
    }
}
