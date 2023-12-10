# ForceFormClose

![php](https://img.shields.io/badge/php-8.1-informational)
![api](https://img.shields.io/badge/pocketmine-5.0-informational)

Apparently there's a bug, that when you get kicked while you're in a form-ui, you won't see the actual kick screen, instead you stay in the ui until you manually close it.
Well, this plugin forces a close of the player's current form, so they actually get kicked.

## Manually force a form-ui close
If you want to add this to your own plugin, just do this to force a form-ui close:
```php
$player->getNetworkSession()->sendDataPacket(ChangeDimensionPacket::create(
    DimensionIds::NETHER,
    Vector3::zero(),
    false
));
```