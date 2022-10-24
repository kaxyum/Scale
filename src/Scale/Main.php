<?php

namespace Scale;

use Scale\ScaleCMD;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PLuginBase implements Listener
{
    private static $instance;

    private Config $config;

    public function onEnable(): void
    {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->saveDefaultConfig();
        self::$instance = $this;
        $this->config = new Config($this->getDataFolder()."config.yml",Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getServer()->getCommandMap()->register("", new ScaleCMD());
    }

    public static function getInstance(): Main{
        return self::$instance;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

}