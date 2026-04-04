<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Card = 'card';
    case Oxxo = 'oxxo';
    case Spei = 'spei';
    case GiftCard = 'gift_card';
}
