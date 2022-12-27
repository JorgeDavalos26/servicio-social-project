<?php

namespace App\Enums;

enum TypesQuestion: String {
    case STRING = 'string'; // strings
    case INT = 'int'; // numbers
    case FLOAT = 'float'; // decimal
    case DATETIME = 'datetime'; // date and time
    case TIME = 'time'; // time
    case BOOLEAN = 'boolean'; // true and false
    case FILE = 'file'; // uploaded file or base64 (at the moment)
    case SELECT = 'select'; // select one (a string)
    case MULTIPLE = 'multiple'; // multiselect

    // not yet considered at all
    case MULTIPLE_FILE = 'multiple_file'; // multiple files
    case MULTIPLE_DATETIME = 'multiple_datetime'; // multiple dates
    case RANGE_DATETIME = 'range_datetime'; // a range between two dates
}
