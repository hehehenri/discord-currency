<?php

/*
 * This file is apart of the DiscordPHP project.
 *
 * Copyright (c) 2021 David Cole <david.cole1340@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace Discord\Repository;

use Discord\Http\Endpoint;
use Discord\Parts\Guild\Guild;
use React\Promise\ExtendedPromiseInterface;

/**
 * Contains guilds that the user is in.
 *
 * @see \Discord\Parts\Guild\Guild
 */
class GuildRepository extends AbstractRepository
{
    /**
     * {@inheritdoc}
     */
    protected $endpoints = [
        'all' => Endpoint::USER_CURRENT_GUILDS,
        'get' => Endpoint::GUILD,
        'create' => Endpoint::GUILDS,
        'update' => Endpoint::GUILD,
        'delete' => Endpoint::GUILD,
        'leave' => Endpoint::USER_CURRENT_GUILD,
    ];

    /**
     * {@inheritdoc}
     */
    protected $class = Guild::class;

    /**
     * Causes the client to leave a guild.
     *
     * @param Guild|snowflake $guild
     *
     * @return ExtendedPromiseInterface
     */
    public function leave($guild): ExtendedPromiseInterface
    {
        if ($guild instanceof Guild) {
            $guild = $guild->id;
        }

        return $this->http->delete(Endpoint::bind(Endpoint::USER_CURRENT_GUILD, $guild))->then(function () use ($guild) {
            $this->pull('id', $guild);

            return $this;
        });
    }
}
