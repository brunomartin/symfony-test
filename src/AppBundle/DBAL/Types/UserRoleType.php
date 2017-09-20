<?php
namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class UserRoleType extends AbstractEnumType
{
    const ROLE_USER = 'RU';
    const ROLE_ADMIN = 'RA';

    protected static $choices = [
        self::ROLE_USER => 'User Role',
        self::ROLE_ADMIN => 'Admin Role',
    ];
}
