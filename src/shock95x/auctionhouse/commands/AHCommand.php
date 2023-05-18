<?php
declare(strict_types=1);

namespace shock95x\auctionhouse\commands;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use shock95x\auctionhouse\AuctionHouse;
use shock95x\auctionhouse\commands\subcommand\AboutCommand;
use shock95x\auctionhouse\commands\subcommand\AdminCommand;
use shock95x\auctionhouse\commands\subcommand\CategoryCommand;
use shock95x\auctionhouse\commands\subcommand\ConvertCommand;
use shock95x\auctionhouse\commands\subcommand\ExpiredCommand;
use shock95x\auctionhouse\commands\subcommand\ListingsCommand;
use shock95x\auctionhouse\commands\subcommand\ReloadCommand;
use shock95x\auctionhouse\commands\subcommand\SellCommand;
use shock95x\auctionhouse\commands\subcommand\ShopCommand;
use shock95x\auctionhouse\commands\subcommand\TestCommand;
use shock95x\auctionhouse\menu\ShopMenu;
use shock95x\auctionhouse\menu\type\AHMenu;

class AHCommand extends BaseCommand {

    protected function prepare(): void {
		$this->registerSubCommand(new ShopCommand(AuctionHouse::getInstance(), "shop", "Shows AH shop menu"));
		$this->registerSubCommand(new AdminCommand(AuctionHouse::getInstance(),"admin", "Opens AH admin menu"));
		$this->registerSubCommand(new SellCommand(AuctionHouse::getInstance(),"sell", "Sell item in hand to the AH"));
		$this->registerSubCommand(new CategoryCommand(AuctionHouse::getInstance(),"category", "Opens category menu"));
		$this->registerSubCommand(new ListingsCommand(AuctionHouse::getInstance(),"listings", "Shows player listings"));
		$this->registerSubCommand(new ExpiredCommand(AuctionHouse::getInstance(),"expired", "Shows expired listings"));
		$this->registerSubCommand(new ReloadCommand(AuctionHouse::getInstance(),"reload", "Reload plugin configuration files"));
		$this->registerSubCommand(new AboutCommand(AuctionHouse::getInstance(),"about", "Plugin information"));
		$this->registerSubCommand(new ConvertCommand(AuctionHouse::getInstance(),"convert", "Legacy DB conversion"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
		if(count($args) == 0 && $sender instanceof Player) {
			AHMenu::open(new ShopMenu($sender));
		}
	}
}
