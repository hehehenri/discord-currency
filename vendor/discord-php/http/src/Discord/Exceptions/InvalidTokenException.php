<?php

/*
 * This file is a part of the DiscordPHP-Http project.
 *
 * Copyright (c) 2021 David Cole <david.cole1340@gmail.com>
 *
 * This source file is subject to the MIT license that is
 * bundled with this source code in the LICENSE.md file.
 */

namespace Discord\Http\Exceptions;

/**
 * Thrown when an invalid token is provided to a Discord endpoint.
 *
 * @author David Cole <david.cole1340@gmail.com>
 */
class InvalidTokenException extends RequestFailedException
{
}
