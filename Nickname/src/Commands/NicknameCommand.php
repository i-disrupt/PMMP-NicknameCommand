<?php

namespace kitsu\Nickname\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class NicknameCommand extends Command {
    public function __construct() {
        parent::__construct('nick', "kitsu's nickname command! use it to change your display name.", '', ['n']);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        // Goal: Try to change the name of the command sender, if the command didn't work, let's assume the sender likely didn't send arguments
        try {
            // We need to implement a bad word check.
            // This is a horrible way of doing this, but we're doing it because I don't have much time left.
            // TODO: Implement a better solution
            $bad_words = array("fuck", "shit", "bitch", "piss", "dick", "pussy", "asshole", "bastard", "retard", "cunt", "choad", "bollocks", "wanker", "twat", "penis", "vagina");
            $word = strtolower($args[0]);

            if (in_array($word, $bad_words)) {
                $sender -> sendActionBarMessage(TextFormat::RED . "You cannot set that as your nickname!");
                return;
            }

            if ($sender instanceof Player) {
                if (!$sender -> hasPermission('kitsu.nickname.command')) {
                    $sender -> sendActionBarMessage(TextFormat::RED . 'Sorry! It looks like you do not have permission to execute this command.');
                }

                $sender -> setDisplayName($args[0]); // Set the display name using the arguments passed in the command line.
                $sender -> setNameTag($args[0]); // We're assuming this also changes the name above the player's head.
                $sender -> sendActionBarMessage(TextFormat::GREEN . 'Success! Your new display name is: ' . TextFormat::WHITE . $args[0]);
            } else {
                $sender -> sendActionBarMessage(TextFormat::RED . "This command cannot be run in the console! ");
            }
        } catch (\Throwable $th) {
            $sender -> sendActionBarMessage(TextFormat::RED . "You didn't provide a nickname! /nick <name>");
        }
        
    }
}
