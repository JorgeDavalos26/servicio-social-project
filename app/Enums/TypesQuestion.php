<?php

namespace App\Enums;

enum TypesQuestion: String {
    case STRING = 'string'; // strings
    case INT = 'int'; // numbers
    case FLOAT = 'float'; // numbers with deciaml point
    case DATETIME = 'datetime'; // date and time
    case TIME = 'time'; // time
    case BOOLEAN = 'boolean'; // true and false
    case FILE = 'file'; // base64 (at the moment)
    case SELECT = 'select'; // select one
    case MULTIPLE = 'multiple'; // multiselect
}
