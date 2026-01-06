<?php

namespace EasyGM;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("EasyGM activado");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

        if ($command->getName() === "gm") {
          
            if (!$sender instanceof Player) {
                $sender->sendMessage(TextFormat::RED . "Este comando solo se puede usar dentro del juego.");
                return true;
            }

            if (!$sender->hasPermission("easygm.use")) {
                $sender->sendMessage(TextFormat::RED . "No tienes permiso para usar esto.");
                return true;
            }

            if (!isset($args[0])) {
                $sender->sendMessage(TextFormat::YELLOW . "Uso: /gm <0|1|2|3>");
                return false;
            }

            switch (strtolower($args[0])) {
                case "1":
                case "c":
                case "creative":
                    $sender->setGamemode(GameMode::CREATIVE());
                    $sender->sendMessage(TextFormat::GREEN . "Modo de juego actualizado a Creativo.");
                    break;

                case "0":
                case "s":
                case "survival":
                    $sender->setGamemode(GameMode::SURVIVAL());
                    $sender->sendMessage(TextFormat::GREEN . "Modo de juego actualizado a Supervivencia.");
                    break;

                case "2":
                case "a":
                case "adventure":
                    $sender->setGamemode(GameMode::ADVENTURE());
                    $sender->sendMessage(TextFormat::GREEN . "Modo de juego actualizado a Aventura.");
                    break;

                case "3":
                case "sp":
                case "spectator":
                    $sender->setGamemode(GameMode::SPECTATOR());
                    $sender->sendMessage(TextFormat::GREEN . "Modo de juego actualizado a Espectador.");
                    break;

                default:
                    $sender->sendMessage(TextFormat::RED . "Modo desconocido. Usa 0, 1, 2 o 3.");
                    break;
            }
            return true;
        }
        return false;
    }
}
