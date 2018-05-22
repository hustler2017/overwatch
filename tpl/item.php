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
 *
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
    <div class="time">~~ мин назад</div>
    <a href="<?= $href ?>" class="title"><?= $title ?></a>
</div>