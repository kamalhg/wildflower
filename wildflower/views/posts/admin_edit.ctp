<?php 
    if ($session->check('Message.flash')) {
        $session->flash();
    }

    echo 
    $form->create('Post', array('url' => $html->url(array('action' => 'admin_update', 'base' => false)), 'class' => 'editor_form')),
    $form->input('title', array(
        'label' => __('Post title', true)
    )),
    $form->input('content', array(
        'type' => 'textarea',
        'class' => 'tinymce fill_screen',
        'rows' => '25',
        'label' => __('Body', true),
        'div' => array('class' => 'input editor')
    )),
    '<div>',
    $form->hidden('id'),
    $form->hidden('draft'),
    $form->hidden('Category.Category'),
    '</div>';
?>
    
<div id="edit-buttons">
    <?php echo $this->element('admin_edit_buttons'); ?>
</div>

<?php echo $form->end(); ?>
    

<?php $partialLayout->blockStart('sidebar'); ?>
    <li class="main_sidebar">
        <?php echo $html->link(
            '<span>Write a new post</span>', 
            array('action' => 'admin_create'),
            array('class' => 'add', 'escape' => false)); ?>
    </li>
    <li class="main_sidebar category_sidebar">
        <h4><?php __('Category'); ?></h4>
        <?php if (empty($this->data['Category'])): ?>
            <span>Not assigned under any categories.</span>
        <?php else: ?>
        <ul>
        <?php foreach ($this->data['Category'] as $category): ?>
            <li><?php echo $category['name']; ?></li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        
        <div id="assign_category_box">
        <?php 
            echo $form->input('category_id', array('type' => 'select', 'options' => $categories, 'label' => false, 'empty' => __('select a category...', true), 'value' => $categoryId)); 
            echo $form->submit('Assign', array('name' => 'assign_category'));
        ?>   
        </div>

    </li>
    <li class="main_sidebar">
        <ul class="sidebar-menu-alt edit-sections-menu">
            <li><?php echo $html->link('Options <small>like status, publish date, etc.</small>', array('action' => 'options', $this->data['Post']['id']), array('escape' => false)); ?></li>
            <li><?php echo $html->link('Browse older versions', '#Revisions', array('rel' => 'post-revisions')); ?></li>
            <li><?php echo $html->link("Comments ({$this->data['Post']['comment_count']})", array('action' => 'comments', $this->data['Post']['id'])); ?></li>
        </ul>
    </li>
<?php $partialLayout->blockEnd(); ?>