<div class="users index">
    <h2><?php echo __('Users');?></h2>
    <div class="pagination">
        <ul>
        <?php
            $this->Paginator->options(array(
                'update' => '.span12',
                'evalScripts' => true,
                'before' => '$(".progress").show()',
                'complete' => '$(".progress").hide()',
            ));
            echo $this->Paginator->prev('&laquo; ' . __('previous'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'prev disabled', 'escape' => false, 'disabledTag' => 'span'));
            echo $this->Paginator->numbers(array('modulus' => 20, 'separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'span'));
            echo $this->Paginator->next(__('next') . ' &raquo;', array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'next disabled', 'escape' => false, 'disabledTag' => 'span'));
        ?>
        </ul>
    </div>
    <?php
        $filterParamsString = array();
        foreach ($passedArgsArray as $k => $v) {
                $filterParamsString[] = sprintf(
                    '%s: %s',
                    h(ucfirst($k)),
                    h($v)
                );
        }
        $filterParamsString = implode(' & ', $filterParamsString);
        $data = array(
            'children' => array(
                array(
                    'children' => array(
                        array(
                            'id' => 'create-button',
                            'title' => __('Modify filters'),
                            'fa-icon' => 'search',
                            'onClick' => 'getPopup',
                            'onClickParams' => array($urlparams, 'admin/users', 'filterUserIndex')
                        )
                    )
                ),
                array(
                    'children' => array(
                        array(
                            'requirement' => count($passedArgsArray) > 0,
                            'html' => sprintf(
                                '<span class="bold">%s</span>: %s',
                                __('Filters'),
                                $filterParamsString
                            )
                        ),
                        array(
                            'requirement' => count($passedArgsArray) > 0,
                            'url' => '/admin/users/index',
                            'title' => __('Remove filters'),
                            'fa-icon' => 'times'
                        )
                    )
                ),
                array(
                    'type' => 'search',
                    'button' => 'Filter',
                    'placeholder' => 'Enter value to search',
                    'data' => '',
                )
            )
        );
        echo $this->element('/genericElements/ListTopBar/scaffold', array('data' => $data));
        $tab = "Center";
        $filtered = false;
        if (count($passedArgsArray) > 0) {
            $tab = "Left";
            $filtered = true;
        }
        echo $this->element('Users/userIndexTable');
    ?>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>
    </p>
    <div class="pagination">
        <ul>
        <?php
            echo $this->Paginator->prev('&laquo; ' . __('previous'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'prev disabled', 'escape' => false, 'disabledTag' => 'span'));
            echo $this->Paginator->numbers(array('modulus' => 20, 'separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'span'));
            echo $this->Paginator->next(__('next') . ' &raquo;', array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'next disabled', 'escape' => false, 'disabledTag' => 'span'));
        ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    var passedArgsArray = <?php echo $passedArgs; ?>;
    $(document).ready(function() {
        $('.searchFilterButton').click(function() {
            runIndexFilter(this);
        });
        $('#quickFilterButton').click(function() {
            runIndexQuickFilter();
        });
        $('#quickFilterField').on('keypress', function (e) {
            if(e.which === 13) {
                runIndexQuickFilter();
            }
        });
    });
</script>
<?php
    echo $this->element('/genericElements/SideMenu/side_menu', array('menuList' => 'admin', 'menuItem' => 'indexUser'));
