<?php
/**
 * @var \Web\Views\Form\FormView $this
 */
?>
<ul>
    <?php foreach ($this->elements as $row): ?>
    <?php foreach ($row as $element): ?>
    <?php if ($element['type'] === \phpOMS\Html\TagType::SYMMETRIC): ?>
    <?php if (isset($element['label'])): ?>
    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label>
        <?php endif; ?>
        <?= '<' . $element['tag'] . (isset($element['class']) ? ' class="' . $element['class'] . '"' : '') . '>' . (isset($element['content']) ? $element['content'] : '') . '</' . $element['tag'] . '>'; ?>
        <?php elseif ($element['type'] === \phpOMS\Html\TagType::INPUT): ?>
        <?php if (isset($element['label']) && $element['subtype'] !== 'checkbox'): ?>
    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label>
        <?php endif; ?>
    <li>
        <input<?= (isset($element['visible']) && !$element['visible'] ? ' class="hidden"' : '') ?>
            name="<?= $element['name']; ?>"
            id="<?= isset($element['id']) ? $element['id'] : 'n-' . $element['name']; ?>"
            type="<?= $element['subtype']; ?>"
            value="<?= (isset($element['value']) ? $element['value'] : ''); ?>"
            <?= (isset($element['tabindex']) ? ' tabindex="' . $element['tabindex'] . '"' : ''); ?>
            <?= (isset($element['placeholder']) ? ' placeholder="' . $element['placeholder'] . '"' : ''); ?>
            <?= (isset($element['validate']) ? ' data-validate="' . $element['validate'] . '"' : ''); ?>
            <?= (isset($element['active']) && !$element['active'] ? ' disabled' : '') ?>
            <?= (isset($element['autofocus']) && $element['autofocus'] ? ' autofocus' : '') ?>
            <?= (isset($element['checked']) && $element['checked'] ? ' checked' : '') ?>
            <?= (isset($element['multiple']) && $element['multiple'] ? ' multiple' : '') ?>
            <?= (isset($element['accept']) ? ' accept="' . $element['accept'] . '"' : '') ?>
            <?= (isset($element['class']) ? ' class="' . $element['class'] . '"' : '') ?>>
        <?php if (isset($element['label']) && $element['subtype'] === 'checkbox'): ?>
            <label for="<?= $element['name']; ?>"><?= $element['label']; ?></label>
        <?php endif; ?>
        <?php if (isset($element['info'])): ?>
            <i class="bt-1 b-3 vh"><?= $element['info']; ?></i>
        <?php endif; ?>
        <?php elseif ($element['type'] === \phpOMS\Html\TagType::BUTTON): ?>
            <button<?= (isset($element['class']) ? ' class="' . $element['class'] . '"' : ''); ?><?= (isset($element['name']) ? ' data-name="' . $element['name'] . '"' : ''); ?>
                type="button"<?php if (isset($element['data'])) {
    foreach ($element['data'] as $key => $data) {
        echo ' data-' . $key . '=' . $data;
    }
} ?>><?= $element['label']; ?></button>
        <?php elseif ($element['type'] === \phpOMS\Html\TagType::TEXTAREA): ?>
        <?php if (isset($element['label'])): ?>
    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label>
        <?php endif; ?>
    <li>
        <textarea name="<?= $element['name']; ?>"
                  id="<?= isset($element['id']) ? $element['id'] : 'n-' . $element['name']; ?>"><?= (isset($element['content']) ? $element['content'] : ''); ?></textarea>
        <?php elseif ($element['type'] === \phpOMS\Html\TagType::SELECT): ?>
        <?php if (isset($element['label'])): ?>
    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label>
        <?php endif; ?>
    <li>
        <select 
        name="<?= $element['name']; ?>" id="<?= isset($element['id']) ? $element['id'] : 'n-' . $element['name']; ?>"
            <?= (isset($element['id']) ? ' id="' . $element['id'] . '"' : '') ?>
            <?= (isset($element['class']) ? ' class="' . $element['class'] . '"' : '') ?>>
            <?php foreach ($element['options'] as $option): ?>
                <option
                    value="<?= $option['value']; ?>"<?= (isset($option['selected']) && $option['selected'] ? ' selected' : ''); ?>><?= $option['content']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php elseif ($element['type'] === \phpOMS\Html\TagType::LABEL): ?>

            <label for="<?= $element['for']; ?>"><?= $element['content']; ?></label>
        <?php elseif ($element['type'] === \phpOMS\Html\TagType::ULIST): ?>
        <?php if (isset($element['label'])): ?>
    <li><label for="n-<?= $element['name']; ?>"><?= $element['label']; ?></label>
        <?php endif; ?>
    <li><input type="hidden" name="h-<?= $element['name']; ?>" disabled="disabled"
            <?= (isset($element['id']) ? ' id="' . $element['id'] . '"' : '') ?>
            <?= (isset($element['class']) ? ' class="' . $element['class'] . '"' : '') ?>>
        <ul data-name="l-<?= $element['name']; ?>">
            <?php foreach ($element['list'] as $li) : ?>
            <li><?= $li; ?>
                <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
        <?php if (count($this->submit) > 0): ?>
    <li class="submit">
        <?php foreach ($this->submit as $key => $submit) : ?>
            <input class="<?php if (isset($submit[1]['float']) && $submit[1]['float'] === 1) {
    echo ' rf';
} elseif (isset($submit[1]['float']) && $submit[1]['float'] === -1) {
    echo 'lf';
} ?>" type="submit" name="<?= $key; ?>"
                   value="<?= $submit[0]; ?>"
                   <?= (isset($submit[1]['visible']) && !$submit[1]['visible'] ? ' disabled' : '') ?>
                   <?= isset($submit[1]['formfields']) ? ' data-formfields=\'' . json_encode($submit[1]['formfields']) . '\'' : ''; ?>>
        <?php endforeach; ?>
        <?php endif; ?>
</ul>
