<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Media Images Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <style>
        .media-image-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .media-image-header h2 {
            font-size: 26px;
            line-height: 30px;
        }
        .media-uploader-image-list.media-page{
            width: 100%;
            max-height: 100%;
        }
        .attachment-preview {
            position: relative;
            box-shadow: inset 0 0 15px rgb(0 0 0 / 10%), inset 0 0 0 1px rgb(0 0 0 / 5%);
            background: #eee;
            cursor: pointer;
            width: 100px;
            height: 100px;
        }
        .media-uploader-image-info {
            padding: 20px;
            display: inline-block;
            width: 100%;
        }
        .img-alt-wrap input {
            width: calc(100% - 60px);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="media-image-header">
                            <h2><?php echo e(__('Media Images')); ?></h2>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#media_image_upload_modal"><?php echo e(__('Add New Image')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10">
                                <ul class="media-uploader-image-list media-page">
                                    <?php $__currentLoopData = $all_media_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li
                                            data-date="<?php echo e($image->updated_at); ?>"
                                            data-imgid="<?php echo e($image->id); ?>"
                                            data-imgsrc="<?php echo e(asset('assets/uploads/media-uploader/'.$image->path)); ?>"
                                            data-size="<?php echo e($image->size); ?>"
                                            data-dimension="<?php echo e($image->dimensions); ?>"
                                            data-title="<?php echo e($image->title); ?>"
                                            data-alt="<?php echo e($image->alt); ?>"
                                        >
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <?php 
                                                            $image_url = '';
                                                            if (file_exists('assets/uploads/media-uploader/'.$image->path)) {
                                                                $image_url = asset('assets/uploads/media-uploader/'.$image->path);
                                                            }
                                                            $type = pathinfo($image_url,PATHINFO_EXTENSION);
                                                        ?> 
                                                        <?php if(in_array($type,['pdf','doc','docx','txt','zip','csv','xlsx','xlsm','xlsb','xltx','pptx','pptm','ppt'])): ?>
                                                            <i class="fas fa-file file-icon"></i> 
                                                            <span class="file-name"><?php echo e($type); ?></span>
                                                        <?php else: ?>
                                                            <?php echo render_image_markup_by_attachment_id($image->id); ?>

                                                        <?php endif; ?>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="col-lg-2">
                                <div class="img-sticky-wrap" >
                                    <div class="media-uploader-image-info" id="media-uploader-image-info">
                                        <div class="img-wrapper">
                                            <img src="" alt="">
                                        </div>
                                        <div class="img-info">
                                            <h5 class="img-title"></h5>
                                            <ul class="img-meta" style="display: none">
                                                <li class="date"></li>
                                                <li class="dimension"></li>
                                                <li class="size"></li>
                                                <li class="image_id" style="display:none;"></li>
                                                <li class="imgsrc"></li>
                                                <li class="imgalt">
                                                    <div class="img-alt-wrap">
                                                        <input type="text" name="img_alt_tag">
                                                        <button class="btn btn-success img_alt_submit_btn"><i class="fas fa-check"></i></button>
                                                    </div>
                                                </li>
                                            </ul>
                                            <form method="post" action="<?php echo e(route('admin.upload.media.file.delete')); ?>" class="delete_image_form" style="display: none">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="img_id" id="info_image_id_input">
                                                <button type="submit" class=" btn btn-xs btn-danger btn-sm mb-3 mr-1"><i class="ti-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="media_image_upload_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Upload Images')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning"><?php echo e(__('Reload the page to see latest uploaded images')); ?></div>
                    <div class="dropzone-form-wrapper">
                        <form action="<?php echo e(route('admin.upload.media.file')); ?>" method="post" class="dropzone" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function (){
            $(window).on('scroll',function (e){
                var scrolltop = $(window).scrollTop();
                var mtop = scrolltop - 400;
                if (scrolltop > 450){
                    $('#media-uploader-image-info').css({marginTop: mtop+'px'});
                }else{
                    $('#media-uploader-image-info').css({marginTop: '0px'});
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/media-images/media-images.blade.php ENDPATH**/ ?>