<?php
/**
 * Created by Averin Ilya.
 * Date: 22.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 *
 * $title
 * $href
 * $domain
 * $time
 */

$domains_names = [
    1 => 'weblancer',
    2 => 'freelancehunt',
    3 => 'freelancim',
    4 => 'freelance',
    5 => 'fl',
];

?>
<div class="item <?= $domains_names[$domain] ?>">
    <div data-timestamp="<?= $time ?>" class="time"><?= $label ?></div>
    <a target="_blank" href="<?= $href ?>" class="title"><?= $title ?></a>
</div>