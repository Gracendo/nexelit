<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Words Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">
                                <?php echo e(__("Change All Words")); ?>

                            </h4>
                            <div class="header-title">

                                <a class="btn btn-secondary btn-sm margin-bottom-30 mr-1" href="<?php echo e(route('admin.languages')); ?>">  <i class="fa fa-backward" aria-hidden="true"></i> <?php echo e(__('All Languages')); ?></a>
                                <a href="#" id="regenerate_source_text_btn" class="btn btn-warning margin-bottom-30 btn-sm"><?php echo e(__('Regenerate Source Texts')); ?></a>
                                <button class="btn btn-info btn-sm margin-bottom-30 add_new_string_btn"  data-toggle="modal" data-target="#add_new_string_modal"> <i class="fas fa-plus mr-1"></i> <?php echo e(__('Add New String')); ?></button>
                            </div>
                        </div>
                        <p class="text-info margin-bottom-20"><?php echo e(__('select any source text to translate it, then enter your translated text in textarea hit update')); ?></p>
                        <div class="language-word-translate-box">
                            <div class="search-box-wrapper">
                                <input type="text" name="word_search" id="word_search" placeholder="<?php echo e(__('Search Source Text...')); ?>">
                            </div>
                            <div class="top-part">
                                <div class="single-string-wrap">
                                    <div class="string-part"><?php echo e(__('Source Text')); ?></div>
                                    <div class="translated-part"><?php echo e(__('Translation')); ?></div>
                                </div>
                            </div>
                            <div class="middle-part">
                                <?php $__currentLoopData = $all_word; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-string-wrap">
                                        <div class="string-part" data-key="<?php echo e($key); ?>"><?php echo e($key); ?></div>
                                        <div class="translated-part" data-trans="<?php echo e($value); ?>"><?php echo e($key === $value ? '' : $value); ?></div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="footer-part">
                                <h6 id="selected_source_text"><span><?php echo e(__('Source Text:')); ?></span> <strong class="text"></strong></h6>
                                <form action="<?php echo e(route('admin.languages.words.update',$lang_slug)); ?>" method="POST" id="langauge_translate_form" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="type" value="<?php echo e($type); ?>">
                                    <input type="hidden" name="string_key">
                                    <div class="from-group">
                                        <label for=""><?php echo e(__('Translate To')); ?> <strong><?php echo e($language->name); ?></strong></label>
                                        <textarea name="translate_word" cols="30" rows="5" class="form-control" placeholder="<?php echo e(__('enter your translate words')); ?>"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                                </form>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_new_string_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Add New Translate String')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.languages.add.string')); ?>" id="add_new_string_modal_form"  method="post">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="slug" value="<?php echo e($lang_slug); ?>">
                        <input type="hidden" name="type" value="<?php echo e($type); ?>">
                        <div class="form-group">
                            <label for="string"><?php echo e(__('String')); ?></label>
                            <input type="text" class="form-control" name="string" placeholder="<?php echo e(__('String')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="translate_string"><?php echo e(__('Translated String')); ?></label>
                            <input type="text" class="form-control" name="translate_string" placeholder="<?php echo e(__('Translated String')); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";

            $(document).ready(function (){
                $(document).on('click','.language-word-translate-box .middle-part .single-string-wrap .string-part',function (e){
                    e.preventDefault();
                    let langKey = $(this).data('key');
                    let langValue = $(this).next().data('trans');
                    let formContainer = $('#langauge_translate_form');
                    $('#selected_source_text strong').text(langKey);
                    formContainer.find('input[name="string_key"]').val(langKey);
                    formContainer.find('textarea[name="translate_word"]').val(langValue);
                });
                //search source text
                $(document).on('keyup','#word_search',function (e){
                    e.preventDefault();
                    let searchText = $(this).val();
                    var allSourceText = $('.language-word-translate-box .middle-part .single-string-wrap .string-part');
                    $.each(allSourceText,function (index,value){
                        var text = $(this).text();
                        var found = text.toLowerCase().match(searchText.toLowerCase().trim());
                        if (!found){
                            $(this).parent().hide();
                        }else{
                            $(this).parent().show();
                        }
                    });
                });

                $(document).on('click','#regenerate_source_text_btn',function (e){
                    e.preventDefault();
                    //admin.languages.regenerate.source.texts
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure?")); ?>',
                        text: '<?php echo e(__("It will delete current source texts, you will lose your current translated data!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, Generate!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo e(route('admin.languages.regenerate.source.texts')); ?>",
                                data: {
                                    _token : "<?php echo e(csrf_token()); ?>",
                                    slug : "<?php echo e($lang_slug); ?>",
                                    type : "<?php echo e($type); ?>",
                                },
                                success : function (){
                                    toastr.success("<?php echo e(__('source text generate success')); ?>")
                                    location.reload();
                                }
                            });
                        }
                    });

                });

            });


        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/languages/edit-words.blade.php ENDPATH**/ ?>