<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nestable.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Menu')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapper d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e(__('Edit Menu')); ?></h4>
                            <div class="btn-wrapper">
                                <a href="<?php echo e(route('admin.menu')); ?>" class="btn btn-primary btn-xs"><?php echo e(__('All Menus')); ?></a>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.menu.update',$page_post->id)); ?>" id="menu_update_form" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" name="menu_id" id="menu_id" value="<?php echo e($page_post->id); ?>">
                            <?php echo csrf_field(); ?>
                            <?php
                                $menu_content = '';
                                if (!empty($page_post->content)){
                                    $menu_content = $page_post->content;
                                }else{
                                    $menu_content = '[{"ptype":"custom","pname":"Home","purl":"@url","id":1}]';
                                }
                            ?>
                            <textarea  id="menu_content" name="menu_content" class="form-control d-none" ><?php echo e($menu_content); ?></textarea>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label><?php echo e(__('Language')); ?></label>
                                        <select name="lang" id="language" class="form-control">
                                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($lang->slug == $page_post->lang): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="<?php echo e($page_post->title); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="menu-left-side-content">
                                        <h3 class="title"><?php echo e(__('Add menu items')); ?></h3>
                                        <div class="accordion accordion-wrapper" id="add_menu_item_accordion">
                                            <div class="card">
                                                <div class="card-header" id="page-list-items">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#page-list-items-content"
                                                                aria-expanded="true"
                                                                aria-controls="page-list-items-content">
                                                            <?php echo e(__('Pages')); ?>

                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="page-list-items-content" class="collapse show"
                                                     aria-labelledby="page-list-items"
                                                     data-parent="#add_menu_item_accordion">
                                                    <div class="card-body">
                                                        <ul class="page-list-ul">
                                                            <li data-ptype="custom" data-purl="@url" data-pname="<?php echo e(__('Home')); ?>">
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="menu-item-checkbox">
                                                                    <?php echo e(__('Home')); ?>

                                                                </label>
                                                            </li>
                                                            <?php echo render_pages_list($page_post->lang); ?>

                                                        </ul>
                                                        <div class="form-group">
                                                            <button type="button" id="add_page_to_menu"
                                                                    class="btn btn-primary btn-xs mt-4 pr-4 pl-4 add_page_to_menu"><?php echo e(__('Add To Menu')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo render_dynamic_pages_list($page_post->lang); ?>

                                            <?php echo render_mega_menu_list($page_post->lang); ?>

                                            <div class="card">
                                                <div class="card-header" id="custom-links">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button"
                                                                data-toggle="collapse"
                                                                data-target="#custom-links-content"
                                                                aria-expanded="false"
                                                                aria-controls="custom-links-content">
                                                            <?php echo e(__('Custom Links')); ?>

                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="custom-links-content" class="collapse"
                                                     aria-labelledby="custom-links"
                                                     data-parent="#add_menu_item_accordion">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="custom_url"><strong><?php echo e(__("URL")); ?></strong></label>
                                                            <input type="text" name="custom_url" id="custom_url"
                                                                   class="form-control"
                                                                   placeholder="<?php echo e(__('https://')); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="custom_label_text"><strong><?php echo e(__("Link Text")); ?></strong></label>
                                                            <input type="text" name="custom_label_text"
                                                                   id="custom_label_text" class="form-control"
                                                                   placeholder="<?php echo e(__('label text')); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="button" id="add_custom_links"
                                                                    class="btn btn-primary btn-xs mt-4 pr-4 pl-4"><?php echo e(__('Add To Menu')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                   <div class="menu-structure-wrapper">
                                       <div class="card">
                                           <div class="card-header">
                                               <h3 class="title"><?php echo e(__('Menu Structure')); ?></h3>
                                           </div>
                                           <div class="card-body">
                                               <section id="drop_down_menu_builder_wrapper">
                                                   <div class="dd" id="nestable">
                                                       <ol class="dd-list">
                                                           <?php if(!empty($page_post->content)): ?>
                                                               <?php echo render_draggable_menu($page_post->id); ?>

                                                           <?php else: ?>
                                                               <li class="dd-item" data-id="1" data-purl="@url" data-pname="<?php echo e(__('Home')); ?>" data-ptype="custom">
                                                                   <div class="dd-handle">
                                                                       <?php echo e(__('Home')); ?>

                                                                   </div>
                                                                   <span class="remove_item">x</span>
                                                               </li>
                                                           <?php endif; ?>
                                                       </ol>
                                                   </div>
                                               </section><!-- END #demo -->
                                           </div>
                                       </div>
                                   </div>
                                    <div class="form-group">
                                        <button type="submit" id="menu_structure_submit_btn" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/jquery.nestable.js')); ?>"></script>
    <script>
        $(document).ready(function () {


            $('#nestable').nestable({
                group: 1,
                maxDepth:5
            }).on('change', function (e) {
            });

            $(document).on('click','.add_mega_menu_to_menu',function (e) {
                e.preventDefault();

                var allList = $(this).parent().prev().find('input[type="checkbox"]:checked');
                var draggAbleMenuWrap = $('#nestable > ol');

                $.each(allList,function (index,value) {
                    $(this).attr('checked',false);
                    var draggAbleMenuLength = $('#nestable ol li').length + 1;
                    var allDataAttr = '';
                    var menuType = $(this).parent().parent().data('ptype');
                    var itemSelectMarkup = '';
                    allDataAttr += ' data-ptype="'+menuType+'"';
                    var randomID = Math.floor((Math.random() * 99999999) + 1);
                    var oldRandomId  = randomID;
                    var AjaxRandomId  = randomID;
                    draggAbleMenuWrap.append('<li class="dd-item" data-uniqueid="'+oldRandomId+'" data-id="'+draggAbleMenuLength+'" '+ allDataAttr +'>\n' +
                        ' <div class="dd-handle">'+$(this).parent().text()+'</div>\n' +
                        '<span class="remove_item">x</span>'+
                        '<span class="expand"><i class="ti-angle-down"></i></span>'+
                        '<div class="dd-body hide">' +
                        '<p>loading items...</p>'+
                        '</div>'+
                        '</li>');

                        $.ajax({
                            type: 'POST',
                            url: "<?php echo e(route('admin.mega.menu.item.select.markup')); ?>",
                            data:{
                                _token: "<?php echo e(csrf_token()); ?>",
                                type : menuType,
                                lang : $('select[name="lang"]').val(),
                                menu_id : $('#menu_id').val(),
                            },
                            success:function (data) {
                                var html = data;
                                setTimeout(function () {
                                    $('li[data-uniqueid="'+AjaxRandomId+'"] .dd-body').html(html);
                                },1000);
                            }
                        });

                });

            });
            $(document).on('click','.add_page_to_menu',function (e) {
                e.preventDefault();
                //nestable
                var allList = $(this).parent().prev().find('input[type="checkbox"]:checked');
                var draggAbleMenuWrap = $('#nestable > ol');
                $.each(allList,function (index,value) {
                    $(this).attr('checked',false);
                    var draggAbleMenuLength = $('#nestable ol li').length + 1;
                    var allDataAttr = '';
                    var menuType = $(this).parent().parent().data('ptype');

                    if(menuType == 'static'){

                        var menuPslug = $(this).parent().parent().data('pslug');
                        var menuPname = $(this).parent().parent().data('pname');

                        allDataAttr += 'data-pname="'+menuPname+'"';
                        allDataAttr += ' data-pslug="'+menuPslug+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';

                    }else if(menuType == 'dynamic'){

                        var menuPid = $(this).parent().parent().data('pid');

                        allDataAttr += 'data-pid="'+menuPid+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';

                    }else if(menuType == 'custom'){

                        var menuPurl = $(this).parent().parent().data('purl');
                        var menuPName = $(this).parent().parent().data('pname');

                        allDataAttr += 'data-purl="'+menuPurl+'"';
                        allDataAttr += 'data-pname="'+menuPName+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';
                    }else{
                        var menuPid = $(this).parent().parent().data('pid');

                        allDataAttr += 'data-pid="'+menuPid+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';
                    }
                    draggAbleMenuWrap.append('<li class="dd-item" data-id="'+draggAbleMenuLength+'" '+ allDataAttr +'>\n' +
                        ' <div class="dd-handle">'+$(this).parent().text()+'</div>\n' +
                        '<span class="remove_item">x</span>'+
                        '<span class="expand"><i class="ti-angle-down"></i></span>'+
                        '<div class="dd-body hide">' +
                        '<input type="text" class="icon_picker" placeholder="eg: fas-fa-facebook"/>'+
                        '</div>'+
                        '</li>');
                });
            });

            $(document).on('click','#add_custom_links',function (e) {
                e.preventDefault();

                var draggAbleMenuWrap = $('#nestable > ol');

                    var draggAbleMenuLength = $('#nestable ol li').length + 1;

                    var menuType = $(this).parent().parent().data('ptype');
                    var menuName = $('#custom_label_text').val();//custom_label_text
                    var menuSlug = $('#custom_url').val();//custom_url

                    draggAbleMenuWrap.append('<li class="dd-item" data-id="'+draggAbleMenuLength+'" data-ptype="custom" data-purl="'+menuSlug+'" data-pname="'+menuName+'">\n' +
                        ' <div class="dd-handle">'+menuName+'</div>\n' +
                        '<span class="remove_item">x</span>'+
                        '<span class="expand"><i class="ti-angle-down"></i></span>'+
                        '<div class="dd-body hide"><input type="text" class="anchor_target" placeholder="eg: _blank"/><input type="text" class="icon_picker" placeholder="eg: fas-fa-facebook"/></div>'+
                        '</li>');
                $('#custom_label_text').val('');
                $('#custom_url').val('');
            });
            $(document).on('input','.icon_picker',function (e) {
                var el = $(this);
                var value = el.val();

                 if(value != '' ){
                    el.parent().parent().attr('data-icon',value);
                 }else{
                     el.parent().parent().removeAttr('data-icon');
                 }
            });
            $(document).on('input','.anchor_target',function (e) {
                var el = $(this);
                var value = el.val();

                if(value != '' ){
                    el.parent().parent().attr('data-antarget',value);
                }else{
                    el.parent().parent().removeAttr('data-antarget');
                }
            });
            $(document).on('input','.static_pname',function (e) {
                var el = $(this);
                var value = el.val();

                if(value != '' ){
                    el.parent().parent().attr('data-pname',value);
                }else{
                    el.parent().parent().removeAttr('data-pname');
                }
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).parent().remove();
            });

            $('body').on('change','select[name="items_id"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var item_id = $(this).val();
                if(item_id != '' ){
                    el.parent().parent().attr('data-items_id',item_id);
                }else{
                    el.parent().parent().removeAttr('data-items_id');
                }
            });
            $('body').on('change','select[name="mega_menu_order"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var item_id = $(this).val();
                if(item_id != '' ){
                    el.parent().parent().parent().attr('data-mega_menu_order',item_id);
                }else{
                    el.parent().parent().parent().removeAttr('data-mega_menu_order');
                }
            });

            $('body').on('change','select[name="mega_menu_orderby"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var item_id = $(this).val();
                if(item_id != '' ){
                    el.parent().parent().parent().attr('data-mega_menu_orderby',item_id);
                }else{
                    el.parent().parent().parent().removeAttr('data-mega_menu_orderby');
                }
            });
            $('body').on('change','input[name="category_status"]',function (e) {
                e.preventDefault();
                var el = $(this);
                if(el.is(':checked') ){
                    el.parent().parent().parent().parent().attr('data-category_status','on');
                }else{
                    el.parent().parent().parent().parent().removeAttr('data-category_status');
                }
            });

            $(document).on('click','#menu_structure_submit_btn',function (e) {
                e.preventDefault();
                var alldata = $('#nestable').nestable('serialize');
                $('#menu_content').val(JSON.stringify(alldata));
                $(this).addClass("disabled")
                $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e(__("Updating")); ?>');
                // console.log(alldata)
                $('#menu_update_form').submit();
            })

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/menu/menu-edit.blade.php ENDPATH**/ ?>