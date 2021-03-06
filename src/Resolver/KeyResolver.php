<?php

namespace Codervio\Envmanager\Resolver;

use Codervio\Envmanager\Exceptions\ParseException;

class KeyResolver extends AbstractResolver
{
    /**
     * Unix ksh, bash, bourne shells
     */
    const REG_EXPORT = '/export/';

    /**
     * Unix CSH shells
     */
    const REG_SETENV = '/setenv/';

    /**
     * Unix CSH shells with camel case for Apache environment
     */
    const REG_SETENV_CAMELCASE = '/SetEnv/';

    public function execute($value)
    {
        $value = preg_replace(self::REG_EXPORT, (string)null, $value);
        $value = preg_replace(self::REG_SETENV, (string)null, $value);
        $value = preg_replace(self::REG_SETENV_CAMELCASE, (string)null, $value);

        if (is_numeric(substr($value, 0, 1))) {
            throw new ParseException(sprintf("Numeric should not start with number: %s", $value));
        }

        return trim($value);
    }
}