<?php
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[\Modules\Navigation\Models\NavigationType::TOP])): ?>
    <ul id="t-nav" role="navigation">

        <?php foreach ($this->nav[\Modules\Navigation\Models\NavigationType::TOP] as $key => $parent) :
        foreach ($parent as $link) : ?>
        <li><a href="<?= \phpOMS\Uri\UriFactory::build($link['nav_uri']); ?>">

                <?php if (isset($link['nav_icon'])) : ?>
                    <i class="<?= $link['nav_icon']; ?>"></i>
                <?php endif; ?>

                <?= $this->l11n->lang['Navigation'][$link['nav_name']]; ?></a>
            <?php endforeach;
            endforeach; ?>

    </ul>
<?php endif; ?>