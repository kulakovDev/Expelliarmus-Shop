<?php

namespace Modules\Warehouse\Enums;

enum ProductAttributeTypeEnum: int
{
    case STRING = 0;

    case NUMBER = 1;

    case COLOR = 3;

    case DECIMAL = 4;

    case ARRAY = 5;

    case BOOLEAN = 6;
}
