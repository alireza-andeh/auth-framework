<?php

namespace andeh\Framework\ServiceContract\Enums;

enum AuthMethod :string
{
    case FORM       = 'form';
    case JWT        = 'jwt';
    case BASIC      = 'basic';
    #TODO APY_KEY AND OAUTH2

}
