<?php

/*
 * This file is apart of the DiscordPHP project.
 *
 * Copyright (c) 2021 David Cole <david.cole1340@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace Discord\Repository\Guild;

use Discord\Http\Endpoint;
use Discord\Parts\Guild\Emoji;
use Discord\Repository\AbstractRepository;

/**
 * Contains emojis that belong to guilds.
 *
 * @see \Discord\Parts\Guild\Emoji
 * @see \Discord\Parts\Guild\Guild
 */
class EmojiRepository extends AbstractRepository
{
    /**
     * {@inheritdoc}
     */
    protected $endpoints = [
        'all' => Endpoint::GUILD_EMOJIS,
        'create' => Endpoint::GUILD_EMOJIS,
        'delete' => Endpoint::GUILD_EMOJI,
        'update' => Endpoint::GUILD_EMOJI,
    ];

    /**
     * {@inheritdoc}
     */
    protected $class = Emoji::class;
}
