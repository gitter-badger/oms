<?php
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[\Modules\Navigation\Models\NavigationType::SIDE])) : ?>
    <ul id="s-nav" role="navigation">

        <?php foreach ($this->nav[\Modules\Navigation\Models\NavigationType::SIDE][\Modules\Navigation\Models\LinkType::CATEGORY] as $key => $parent) : ?>
        <li>
            <ul>
                <li>

                    <?php if (isset($parent['nav_icon'])) : ?>
                        <i class="<?= $parent['nav_icon']; ?>"></i>
                    <?php endif; ?>

                    <?= $this->l11n->lang['Navigation'][$parent['nav_name']]; ?><i class="fa fa-chevron-down min"></i>
                    <i class="fa fa-chevron-up max vh"></i>

                    <?php foreach ($this->nav[\Modules\Navigation\Models\NavigationType::SIDE][\Modules\Navigation\Models\LinkType::LINK] as $key2 => $link) :
                    if ($link['nav_parent'] === $parent['nav_id']) : ?>
                <li>
                    <a href="<?= \phpOMS\Uri\UriFactory::build($link['nav_uri']); ?>"><?= $this->l11n->lang['Navigation'][$link['nav_name']]; ?></a>
                    <?php endif;
                    endforeach; ?>
            </ul>
            <?php endforeach; ?>

    </ul>
<?php endif; ?>