<?php
namespace Jibix\ForceFormClose;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\ChangeDimensionPacket;
use pocketmine\network\mcpe\protocol\DisconnectPacket;
use pocketmine\network\mcpe\protocol\types\DimensionIds;
use pocketmine\plugin\PluginBase;
use ReflectionClass;


/**
 * Class Main
 * @package Jibix\ForceFormClose
 * @author Jibix
 * @date 10.12.2023 - 03:42
 * @project ForceFormClose
 */
final class Main extends PluginBase implements Listener{

    protected function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPacketSend(DataPacketSendEvent $event): void{
        foreach ($event->getPackets() as $packet) {
            if (!$packet instanceof DisconnectPacket) continue;
            foreach ($event->getTargets() as $target) {
                if (($player = $target->getPlayer()) === null) continue;
                $property = (new ReflectionClass($player))->getProperty("forms");
                $property->setAccessible(true);
                if ($property->getValue($player)) $target->sendDataPacket(ChangeDimensionPacket::create(DimensionIds::NETHER, Vector3::zero(), false));
            }
        }
    }
}